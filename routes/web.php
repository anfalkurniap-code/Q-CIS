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
<<<<<<< HEAD
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ShopController;
=======
use App\Http\Controllers\profilekepalatokoController;
>>>>>>> 4ce1ea0 (halaman profile toko dan report)

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

// Route Logout
Route::post('/logout', [AuthKasirController::class, 'logout'])->name('logout');


// ==========================================
// 3. HALAMAN PETUGAS KASIR & GUDANG
// ==========================================
// Kasir
Route::get('/HalamanDepanKasir', function () {
    return view('HalamanDepanKasir');
})->name('dashboard.kasir');

// Callback Penanganan Data Dashboard Gudang (Menggunakan kolom 'stock')
$gudangDashboardData = function () {
    $totalSku = DB::table('products')->count();
    $stokKritisCount = DB::table('products')->where('stock', '<=', 10)->count();

    // Mengambil barang yang dimasukkan hari ini
    $barangHariIni = DB::table('products')
        ->whereDate('created_at', today())
        ->orderBy('id', 'desc')
        ->get();

    return view('DashboardGudang', compact('totalSku', 'stokKritisCount', 'barangHariIni'));
};

// Route Gudang Dashboard
Route::get('/HalamanDepanGudang', $gudangDashboardData)->name('dashboard.gudang');
Route::get('/dashboard-gudang', $gudangDashboardData);

// Route Kelola Gudang (Menggunakan kolom 'stock')
Route::get('/kelola-gudang', function () {
    $totalSku = DB::table('products')->count();
    $stokKritisCount = DB::table('products')->where('stock', '<=', 10)->count();

    // Mengambil semua data produk dari database dan dipass sebagai $products
    $products = DB::table('products')->orderBy('id', 'desc')->get();

    return view('kelolagudang', compact('totalSku', 'stokKritisCount', 'products'));
})->name('kelola.gudang');

// Route Profil Gudang (Tampil & Update)
Route::get('/profil-gudang', [ProfilGudangController::class, 'index'])->name('profil.gudang');
Route::put('/profil-gudang', [ProfilGudangController::class, 'update'])->name('profil.gudang.update');

// Route Ubah Password Gudang (Halaman & Proses Update Langsung)
Route::get('/ubah-password-gudang', function () {
    return view('UbahPaswordGudang');
})->name('password.gudang.change');

Route::put('/ubah-password-gudang', function (Request $request) {
    // 1. Validasi Input Form
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

    // 2. Update Password Pengguna di Database
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

    // 3. Kembali ke Halaman Profil Gudang dengan Notifikasi
    return redirect()->route('profil.gudang')->with('success', 'Kata sandi berhasil diperbarui!');
})->name('password.gudang.update');

// Route Input Barang (Dihubungkan ke ProductController & mendukung alias route)
Route::get('/input-barang', [ProductController::class, 'create'])->name('products.create');
Route::get('/input-barang-alt', [ProductController::class, 'create'])->name('input.barang');
Route::post('/input-barang', [ProductController::class, 'store'])->name('products.store');

// Route Stok Kritis (Menggunakan kolom 'stock')
Route::get('/stok-kritis', function () {
    $itemsKritis = DB::table('products')
        ->where('stock', '<=', 10)
        ->orderBy('stock', 'asc')
        ->get();

    $stokKritisCount = $itemsKritis->count();

    return view('stok-kritis', compact('itemsKritis', 'stokKritisCount'));
})->name('stok.kritis');


// ==========================================
// 4. HALAMAN KATALOG / SHOP & TRANSAKSI
// ==========================================
// Halaman Shop (Dinamis dari Database)
Route::get('/HalamanShop', function () {
    $products = DB::table('products')->orderBy('id', 'desc')->get();

    return view('HalamanShop', compact('products'));
})->name('halaman.shop');

Route::get('/halamanpembayaran', function () {
    return view('halamanpembayaran');
});

Route::get('/HalamanKeranjang', function () {
    return view('HalamanKeranjang');
});

Route::get('/HalamanProfile', function () {
    return view('HalamanProfile');
});

Route::get('/laporan-stok', function () {
    return view('LaporanStokAkhir');
});

// Transaksi Controller Routes
Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');
Route::get('/pembayaran', [TransactionController::class, 'pembayaran'])->name('pembayaran');
Route::post('/pembayaran/proses', [TransactionController::class, 'proses'])->name('pembayaran.proses');
Route::get('/pembayaran/berhasil', [TransactionController::class, 'berhasil'])->name('pembayaran.berhasil');


// ==========================================
// 5. ROUTE DASHBOARD KEPALA TOKO & PROFILE
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
                'action'       => 'Update Harga Barang',
                'status'       => 'Success',
                'status_color' => 'bg-emerald-100 text-emerald-700'
            ],
        ]
    ]);
});

Route::get('/HalamanInformasiAkun', function () {
    return view('HalamanInformasiAkun');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/Riwayattransaksi', function () {
    return view('Riwayattransaksi');
});

Route::get('/HalamanKeamananAkun', function () {
    return view('HalamanKeamananAkun');
});

Route::get('/BantuanKasir', function () {
    return view('BantuanKasir');
});

<<<<<<< HEAD
// Route Report Index
Route::get('/ReportIndex', [ReportController::class, 'index']);

// Tambahkan ->name('pembayaran.berhasil') di akhir route
Route::get('/pembayaran/berhasil', [TransactionController::class, 'berhasil'])->name('pembayaran.berhasil');

// Route Halaman Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

// Route Memproses Pembayaran (Form Action)
Route::post('/pembayaran/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses');

// Route Halaman Pembayaran Berhasil
Route::get('/pembayaran/berhasil', [PembayaranController::class, 'berhasil'])->name('pembayaran.berhasil');

Route::get('/HalamanShop', [ShopController::class, 'index'])->name('halaman.shop');

Route::get('/Riwayattransaksi', [PembayaranController::class, 'riwayat'])->name('riwayat.transaksi');
=======
 // Route Home / Dashboard
 Route::get('/dashboardkepalatoko', [DashboardKepalaTokoController::class, 'index'])->name('kepalatoko.home');

 // Route Stock, Orders, Staff (arahkan ke method/view masing-masing)
 Route::get('/kepalatoko/stock', [DashboardKepalaTokoController::class, 'stock'])->name('kepalatoko.stock');
 Route::get('/kepalatoko/orders', [DashboardKepalaTokoController::class, 'orders'])->name('kepalatoko.orders');
 Route::get('/kepalatoko/staff', [DashboardKepalaTokoController::class, 'staff'])->name('kepalatoko.staff');



// ==========================================
// 5. ROUTE DASHBOARD KEPALA TOKO & PROFILE
// ==========================================
Route::get('/HalamanInformasiAkun', function () {
    return view('HalamanInformasiAkun');
});

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/HalamanKeamananAkun', function () {
    return view('HalamanKeamananAkun');
});

Route::get('/BantuanKasir', function () {
    return view('BantuanKasir');
});

// ROUTE LAPORAN (Mendukung URL /report-index DAN /ReportIndex)
Route::get('/report-index', [reportindexController::class, 'index'])->name('report.index');
Route::get('/ReportIndex', [reportindexController::class, 'index']);

// Profil Kepala Toko
Route::get('/profilekepalatoko', [profilekepalatokoController::class, 'index'])->name('profile.index');
Route::post('/profilekepalatoko/update', [profilekepalatokoController::class, 'update'])->name('profile.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboardkepalatoko', [dashboardkepalatokoController::class, 'index'])->name('kepalatoko.home');
    Route::get('/kepalatoko/stock', [dashboardkepalatokoController::class, 'stock'])->name('kepalatoko.stock');
    Route::get('/kepalatoko/orders', [dashboardkepalatokoController::class, 'orders'])->name('kepalatoko.orders');
    Route::get('/kepalatoko/staff', [dashboardkepalatokoController::class, 'staff'])->name('kepalatoko.staff');
});
>>>>>>> 4ce1ea0 (halaman profile toko dan report)
