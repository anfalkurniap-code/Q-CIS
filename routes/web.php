<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\AuthGudangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\dashboardkepalatokoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilGudangController;
use App\Http\Controllers\reportindexController;
use App\Http\Controllers\LoginKepalaTokoController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\profilekepalatokoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. HALAMAN UTAMA / TAMPILAN AWAL
// ==========================================
Route::get('/', function () {
    return view('TampilanAwalLogin');
});

Route::get('/TampilanAwalLogin', function () {
    return view('TampilanAwalLogin');
});

Route::get('/belajar', function () {
    return view('belajar');
});

Route::get('/welcome', function () {
    return view('welcome');
});

// ==========================================
// 2. AUTHENTICATION (LOGIN, LOGOUT, & PENDAFTARAN)
// ==========================================
// Login Kasir
Route::get('/loginKasir', function () {
    return view('loginKasir');
})->name('login');

Route::post('/loginKasir/proses', [AuthKasirController::class, 'login'])->name('login.post');

// Login Gudang
Route::get('/LoginGudang', function () {
    return view('LoginGudang');
})->name('login.gudang');

Route::post('/LoginGudang/proses', [AuthGudangController::class, 'login'])->name('login.gudang.post');

// Login Kepala Toko
Route::get('/LoginKepalaToko', [LoginKepalaTokoController::class, 'showLoginForm'])->name('login.kepalatoko');
Route::post('/LoginKepalaToko', [LoginKepalaTokoController::class, 'login']);

// Route Pendaftaran / Informasi Admin
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/Tampilanpendaftaran', function () {
    return view('Tampilanpendaftaran');
});

// Route Logout
Route::post('/logout', [AuthKasirController::class, 'logout'])->name('logout');

// Route Update & Hapus Produk
Route::put('/products/{id}/update-price', [ProductController::class, 'updatePrice'])->name('products.updatePrice');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


// ==========================================
// 3. HALAMAN PETUGAS KASIR & GUDANG
// ==========================================
// Kasir
Route::get('/HalamanDepanKasir', function () {
    return view('HalamanDepanKasir');
})->name('dashboard.kasir');

// Callback Penanganan Data Dashboard Gudang
$gudangDashboardData = function () {
    $totalSku = DB::table('products')->count();
    $stokKritisCount = DB::table('products')->where('stock', '<=', 10)->count();

    $barangHariIni = DB::table('products')
        ->whereDate('created_at', today())
        ->orderBy('id', 'desc')
        ->get();

    return view('DashboardGudang', compact('totalSku', 'stokKritisCount', 'barangHariIni'));
};

// Route Gudang Dashboard
Route::get('/DashboardGudang', $gudangDashboardData)->name('dashboard.gudang');
Route::get('/HalamanDepanGudang', $gudangDashboardData);
Route::get('/dashboard-gudang', $gudangDashboardData);

// Route Kelola Gudang
Route::get('/kelola-gudang', function () {
    $totalSku = DB::table('products')->count();
    $stokKritisCount = DB::table('products')->where('stock', '<=', 10)->count();

    // Melakukan LEFT JOIN ke tabel categories agar nama kategori terambil
    $products = DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->select(
            'products.*',
            'categories.name as category_name'
        )
        ->orderBy('products.id', 'desc')
        ->get();

    return view('kelolagudang', compact('totalSku', 'stokKritisCount', 'products'));
})->name('kelola.gudang');

// Route Riwayat Transaksi Gudang
Route::get('/Riwayatgudang', function () {
    $riwayatProduk = DB::table('products')->orderBy('id', 'desc')->get();
    $transactions = $riwayatProduk;
    return view('Riwayatgudang', compact('riwayatProduk', 'transactions'));
})->name('Riwayatgudang');

// Route Profil Gudang (Tampil & Update)
Route::get('/profil-gudang', [ProfilGudangController::class, 'index'])->name('profil.gudang');
Route::put('/profil-gudang', [ProfilGudangController::class, 'update'])->name('profil.gudang.update');

// Route Ubah Password Gudang
Route::get('/ubah-password-gudang', function () {
    return view('UbahPaswordGudang');
})->name('password.gudang.change');

Route::put('/ubah-password-gudang', function (Request $request) {
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password'         => ['required', 'confirmed', Password::min(8)],
    ], [
        'current_password.required'         => 'Kata sandi saat ini wajib diisi.',
        'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
        'password.required'                 => 'Kata sandi baru wajib diisi.',
        'password.confirmed'                => 'Konfirmasi kata sandi baru tidak cocok.',
        'password.min'                      => 'Kata sandi baru minimal 8 karakter.',
    ]);

    $user = Auth::user();
    
    if ($user) {
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    } else {
        DB::table('users')
            ->where('id', session('user_id'))
            ->update(['password' => Hash::make($request->password)]);
    }

    return redirect()->route('profil.gudang')->with('success', 'Kata sandi berhasil diperbarui!');
})->name('password.gudang.update');

// Route Input Barang
Route::get('/input-barang', [ProductController::class, 'create'])->name('products.create');
Route::get('/input-barang-alt', [ProductController::class, 'create'])->name('input.barang');
Route::post('/input-barang', [ProductController::class, 'store'])->name('products.store');

// Route Stok Kritis
Route::get('/stok-kritis', function () {
    $itemsKritis = DB::table('products')
        ->where('stock', '<=', 10)
        ->orderBy('stock', 'asc')
        ->get();

    $stokKritisCount = $itemsKritis->count();

    return view('stok-kritis', compact('itemsKritis', 'stokKritisCount'));
})->name('stok.kritis');

// ==========================================
// 4. HALAMAN KATALOG, SHOP & PEMBAYARAN
// ==========================================
Route::get('/HalamanShop', [ShopController::class, 'index'])->name('halaman.shop');
Route::get('/HalamanKeranjang', function () {
    return view('HalamanKeranjang');
});

Route::get('/laporan-stok', function () {
    return view('LaporanStokAkhir');
});

// Transaksi & Katalog Routes
Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');

// Route Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/halamanpembayaran', [PembayaranController::class, 'index']);
Route::post('/pembayaran/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses');
Route::get('/pembayaran/berhasil', [PembayaranController::class, 'berhasil'])->name('pembayaran.berhasil');
Route::get('/berhasil', [PembayaranController::class, 'berhasil']);

// Riwayat Transaksi & Detail
Route::get('/Riwayattransaksi', [PembayaranController::class, 'riwayat'])->name('riwayat.transaksi');
Route::get('/transaksi', function () {
    return view('transaksi');
});

// ==========================================
// 5. ROUTE KEPALA TOKO, MANAJEMEN & PROFILE
// ==========================================
Route::get('/dashboardkepalatoko', function () {
    $lowStockItems = DB::table('products')
        ->where('stock', '<=', 10)
        ->get();

    return view('dashboardkepalatoko', [
        'today_sales'         => 1450000,
        'sales_growth'        => 12,
        'active_orders'       => 24,
        'processing_orders'   => 18,
        'ready_pickup_orders' => 6,
        'low_stock_count'     => $lowStockItems->count(),
        'low_stock_items'     => $lowStockItems,
        'sales_trend'         => [
            'Mon' => 450,
            'Tue' => 620,
            'Wed' => 510,
            'Thu' => 730,
            'Fri' => 680,
            'Sat' => 790,
            'Sun' => 600,
        ],
        'live_operations'     => [
            [
                'user'         => 'Budi',
                'action'       => 'Restock Produk Minuman',
                'status'       => 'Success',
                'status_color' => 'bg-emerald-100 text-emerald-700'
            ],
            [
                'user'         => 'Siti',
                'action'       => 'Memproses Pesanan #1042',
                'status'       => 'Pending',
                'status_color' => 'bg-orange-100 text-orange-700'
            ],
            [
                'user'         => 'Joko',
                'action'       => 'Update Harga Harga Barang',
                'status'       => 'Success',
                'status_color' => 'bg-emerald-100 text-emerald-700'
            ],
        ]
    ]);
});

Route::get('/ManajemenKaryawan', function () {
    return view('ManajemenKaryawan');
});

Route::get('/HalamanInformasiAkun', function () {
    return view('HalamanInformasiAkun');
});

Route::get('/HalamanProfile', function () {
    return view('HalamanProfile');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/HalamanKeamananAkun', function () {
    return view('HalamanKeamananAkun');
});

Route::get('/BantuanKasir', function () {
    return view('BantuanKasir');
});

// ROUTE LAPORAN
Route::get('/report-index', [reportindexController::class, 'index'])->name('report.index');
Route::get('/ReportIndex', [reportindexController::class, 'index']);

// Profil Kepala Toko
Route::get('/profilekepalatoko', [profilekepalatokoController::class, 'index'])->name('profile.kepalatoko.index');
Route::post('/profilekepalatoko/update', [profilekepalatokoController::class, 'update'])->name('profile.kepalatoko.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/kepalatoko/home', [dashboardkepalatokoController::class, 'index'])->name('kepalatoko.home');
    Route::get('/kepalatoko/stock', [dashboardkepalatokoController::class, 'stock'])->name('kepalatoko.stock');
    Route::get('/kepalatoko/orders', [dashboardkepalatokoController::class, 'orders'])->name('kepalatoko.orders');
    Route::get('/kepalatoko/staff', [dashboardkepalatokoController::class, 'staff'])->name('kepalatoko.staff');
});