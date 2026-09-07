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
use App\Http\Controllers\ReportkepalatokoController;

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


// ==========================================
// 3. FITUR PRODUK & PERSETUJUAN (PRODUCT & REPORT KEPALA TOKO)
// ==========================================
Route::put('/products/{id}/update-price', [ProductController::class, 'updatePrice'])->name('products.updatePrice');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Route Persetujuan Barang oleh Kepala Toko
Route::patch('/report/approve/{id}', [ReportkepalatokoController::class, 'approve'])->name('report.approve');
Route::patch('/report/reject/{id}', [ReportkepalatokoController::class, 'reject'])->name('report.reject');


// ==========================================
// 4. HALAMAN PETUGAS GUDANG (GUDANGCONTROLLER & PROFIL)
// ==========================================
// Dashboard Kasir
Route::get('/HalamanDepanKasir', function () {
    return view('HalamanDepanKasir');
})->name('dashboard.kasir');

// Dashboard Gudang
Route::get('/DashboardGudang', [GudangController::class, 'dashboard'])->name('dashboard.gudang');
Route::get('/HalamanDepanGudang', [GudangController::class, 'dashboard']);
Route::get('/dashboard-gudang', [GudangController::class, 'dashboard']);

// Kelola Gudang & Stok Kritis
Route::get('/kelola-gudang', [GudangController::class, 'kelola'])->name('kelola.gudang');
Route::get('/stok-kritis', [GudangController::class, 'kritis'])->name('stok.kritis');
Route::get('/Riwayatgudang', [GudangController::class, 'riwayat'])->name('Riwayatgudang');

// Profil Gudang
Route::get('/profil-gudang', [ProfilGudangController::class, 'index'])->name('profil.gudang');
Route::put('/profil-gudang', [ProfilGudangController::class, 'update'])->name('profil.gudang.update');

// Ubah Password Gudang
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

// Input Barang oleh Petugas Gudang
Route::get('/input-barang', [ProductController::class, 'create'])->name('products.create');
Route::get('/input-barang-alt', [ProductController::class, 'create'])->name('input.barang');
Route::post('/input-barang', [ProductController::class, 'store'])->name('products.store');


// ==========================================
// 5. KATALOG, SHOP & PEMBAYARAN
// ==========================================
Route::get('/HalamanShop', [ShopController::class, 'index'])->name('halaman.shop');
Route::get('/HalamanKeranjang', function () {
    return view('HalamanKeranjang');
});

Route::get('/laporan-stok', function () {
    return view('LaporanStokAkhir');
});

// Transaksi & Katalog
Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');

// Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/halamanpembayaran', [PembayaranController::class, 'index']);
Route::post('/pembayaran/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses');
Route::get('/pembayaran/berhasil', [PembayaranController::class, 'berhasil'])->name('pembayaran.berhasil');
Route::get('/berhasil', [PembayaranController::class, 'berhasil']);

// Riwayat Transaksi
Route::get('/Riwayattransaksi', [PembayaranController::class, 'riwayat'])->name('riwayat.transaksi');
Route::get('/transaksi', function () {
    return view('transaksi');
});


// ==========================================
// 6. ROUTE KEPALA TOKO, MANAJEMEN & PROFILE
// ==========================================
Route::get('/dashboardkepalatoko', function () {
    $lowStockItems = DB::table('products')
        ->where('status', 'approved')
        ->where('stock', '<=', 5)
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
                'status_color' => 'bg-emerald-100 text-[#064e3b]'
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
                'status_color' => 'bg-emerald-100 text-[#064e3b]'
            ],
        ]
    ]);
})->name('dashboard.kepalatoko');

// Profil Kepala Toko
Route::get('/profilekepalatoko', function () {
    return view('profilekepalatoko');
})->name('profile.kepalatoko.index');

Route::post('/profilekepalatoko/update', [profilekepalatokoController::class, 'update'])->name('profile.kepalatoko.update');

// Report Kepala Toko (Laporan & Konfirmasi Persetujuan)
Route::get('/Reportkepalatoko', [ReportkepalatokoController::class, 'index'])->name('report.kepalatoko');

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

// ROUTE LAPORAN INDEX
Route::get('/report-index', [reportindexController::class, 'index'])->name('report.index');
Route::get('/ReportIndex', [reportindexController::class, 'index']);

// ROUTE DIPROTEKSI AUTHENTICATION
Route::middleware(['auth'])->group(function () {
    Route::get('/kepalatoko/home', [dashboardkepalatokoController::class, 'index'])->name('kepalatoko.home');
    Route::get('/kepalatoko/stock', [dashboardkepalatokoController::class, 'stock'])->name('kepalatoko.stock');
    Route::get('/kepalatoko/orders', [dashboardkepalatokoController::class, 'orders'])->name('kepalatoko.orders');
    Route::get('/kepalatoko/staff', [dashboardkepalatokoController::class, 'staff'])->name('kepalatoko.staff');
});