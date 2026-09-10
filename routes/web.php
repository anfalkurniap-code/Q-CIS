<?php

use App\Http\Controllers\AuthGudangController;
use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LoginKepalaTokoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\profilekepalatokoController;
use App\Http\Controllers\ProfilGudangController;
use App\Http\Controllers\ReportkepalatokoController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
})->name('tampilan.awal');

Route::get('/tampilan-awal', function () {
    return view('TampilanAwalLogin');
});

Route::get('/belajar', function () {
    return view('belajar');
});

Route::get('/welcome', function () {
    return view('welcome');
});

// ==========================================
// 2. AUTHENTICATION (HALAMAN & PROSES LOGIN)
// ==========================================

// --- Halaman Login (GET) ---
Route::get('/login-kasir', function () {
    return view('loginKasir');
})->name('login');

Route::get('/LoginKasir', function () {
    return view('loginKasir');
});

Route::get('/login-gudang', function () {
    return view('LoginGudang');
})->name('login.gudang');

Route::get('/LoginGudang', function () {
    return view('LoginGudang');
});

// Login Kepala Toko (Mengarahkan ke view LoginKepalaToko atau Controller)
Route::get('/login-kepala-toko', function () {
    return view('LoginKepalaToko');
})->name('login.kepalatoko');

Route::get('/LoginKepalaToko', function () {
    return view('LoginKepalaToko');
});

Route::get('/login-kepalatoko', function () {
    return view('LoginKepalaToko');
});

// --- Proses Form Login (POST) & Pendaftaran ---
Route::post('/login-kasir/proses', [AuthKasirController::class, 'login'])->name('login.post');
Route::post('/login-gudang/proses', [AuthGudangController::class, 'login'])->name('login.gudang.post');

// Proses Login Kepala Toko
Route::post('/login-kepala-toko', [LoginKepalaTokoController::class, 'login'])->name('login.kepalatoko.post');
Route::post('/LoginKepalaToko', [LoginKepalaTokoController::class, 'login']);
Route::post('/login-kepalatoko', [LoginKepalaTokoController::class, 'login']);

// Halaman Pendaftaran
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/tampilan-pendaftaran', function () {
    return view('Tampilanpendaftaran');
})->name('tampilan.pendaftaran');

// Logout
Route::post('/logout', [AuthKasirController::class, 'logout'])->name('logout');

// ==========================================
// 3. FITUR UTAMA & AREA PENGGUNA
// ==========================================

// ------------------------------------------
// A. AREA KEPALA TOKO
// ------------------------------------------
Route::get('/dashboard-kepalatoko', function () {
    return view('dashboardkepalatoko');
})->name('dashboard.kepalatoko');

Route::get('/dashboardkepalatoko', function () {
    return view('dashboardkepalatoko');
});

Route::get('/DashboardKepalaToko', function () {
    return view('dashboardkepalatoko');
});

Route::get('/profile-kepalatoko', function () {
    return view('profilekepalatoko');
})->name('profile.kepalatoko.index');

Route::post('/profile-kepalatoko/update', [profilekepalatokoController::class, 'update'])->name('profile.kepalatoko.update');

Route::get('/report-kepalatoko', [ReportkepalatokoController::class, 'index'])->name('report.kepalatoko');

Route::get('/Reportkepalatoko', [ReportkepalatokoController::class, 'index']);

Route::patch('/report/approve/{id}', [ReportkepalatokoController::class, 'approve'])->name('report.approve');
Route::patch('/report/reject/{id}', [ReportkepalatokoController::class, 'reject'])->name('report.reject');
Route::post('/report/approve/{id}', [ReportkepalatokoController::class, 'approve']);
Route::post('/report/reject/{id}', [ReportkepalatokoController::class, 'reject']);

Route::get('/manajemen-karyawan', function () {
    return view('ManajemenKaryawan');
})->name('manajemen.karyawan');

// ------------------------------------------
// B. AREA KASIR & SHOP
// ------------------------------------------
Route::get('/HalamanDepanKasir', function () {
    $featuredProducts = Product::where('status', 'approved')
        ->where('stock', '>', 0)
        ->latest()
        ->take(6)
        ->get();

    return view('HalamanDepanKasir', compact('featuredProducts'));
})->name('dashboard.kasir');

Route::get('/shop', [ShopController::class, 'index'])->name('halaman.shop');
Route::get('/HalamanShop', [ShopController::class, 'index']);

Route::get('/keranjang', function () {
    return view('HalamanKeranjang');
})->name('keranjang');
Route::get('/HalamanKeranjang', function () {
    return view('HalamanKeranjang');
});

Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');

// Pembayaran & Transaksi
Route::get('/pembayaran', function () {
    return view('halamanpembayaran');
})->name('pembayaran.index');
Route::get('/halamanpembayaran', function () {
    return view('halamanpembayaran');
});

Route::get('/berhasil', function () {
    return view('berhasil');
})->name('pembayaran.berhasil');

Route::get('/riwayat-transaksi', function () {
    return view('Riwayattransaksi');
})->name('riwayat.transaksi');
Route::get('/Riwayattransaksi', function () {
    return view('Riwayattransaksi');
});

Route::get('/transaksi', function () {
    return view('transaksi');
})->name('transaksi');

// Profil Kasir
Route::get('/profile', function () {
    return view('HalamanProfile');
})->name('profile.index');
Route::get('/HalamanProfile', function () {
    return view('HalamanProfile');
});

Route::get('/informasi-akun', function () {
    return view('HalamanInformasiAkun');
})->name('informasi.akun');

Route::get('/keamanan-akun', function () {
    return view('HalamanKeamananAkun');
})->name('keamanan.akun');

Route::get('/bantuan-kasir', function () {
    return view('BantuanKasir');
})->name('bantuan.kasir');

// ------------------------------------------
// C. AREA PETUGAS GUDANG
// ------------------------------------------
Route::get('/dashboard-gudang', [GudangController::class, 'dashboard'])->name('dashboard.gudang');
Route::get('/DashboardGudang', [GudangController::class, 'dashboard']);

Route::get('/kelola-gudang', [GudangController::class, 'kelola'])->name('kelola.gudang');
Route::get('/KelolaGudang', [GudangController::class, 'kelola']);

Route::get('/stok-kritis', [GudangController::class, 'kritis'])->name('stok.kritis');
Route::get('/StokKritis', [GudangController::class, 'kritis']);

Route::get('/riwayat-gudang', [GudangController::class, 'riwayat'])->name('Riwayatgudang');
Route::get('/Riwayatgudang', [GudangController::class, 'riwayat']);

Route::get('/profil-gudang', [ProfilGudangController::class, 'index'])->name('profil.gudang');
Route::put('/profil-gudang', [ProfilGudangController::class, 'update'])->name('profil.gudang.update');
Route::post('/profil-gudang/update', [ProfilGudangController::class, 'update']);

Route::get('/ubah-password-gudang', function () {
    return view('UbahPaswordGudang');
})->name('password.gudang.change');

Route::get('/input-barang', [ProductController::class, 'create'])->name('products.create');
Route::get('/input-barang-alt', [ProductController::class, 'create'])->name('input.barang');
Route::post('/input-barang', [ProductController::class, 'store'])->name('products.store');

// Product Actions
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::put('/products/{id}/update-price', [ProductController::class, 'updatePrice'])->name('products.updatePrice');
Route::patch('/products/{id}/update-price', [ProductController::class, 'updatePrice']);
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// ------------------------------------------
// D. LAPORAN & LAINNYA
// ------------------------------------------
Route::get('/laporan-stok', function () {
    return view('LaporanStokAkhir');
})->name('laporan.stok');

Route::get('/tentang-aplikasi', function () {
    return view('Tentangaplikasi');
})->name('tentang.aplikasi');
