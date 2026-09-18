<?php

use App\Http\Controllers\AuthGudangController;
use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\dashboardkepalatokoController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LoginKepalaTokoController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\profilekepalatokoController;
use App\Http\Controllers\ProfilGudangController;
use App\Http\Controllers\ReportkepalatokoController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Models\Product; // <--- Import Model Product ditambahkan di sini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;

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
Route::get('/dashboard-kepalatoko', [dashboardkepalatokoController::class, 'index'])->name('dashboard.kepalatoko');
Route::get('/dashboardkepalatoko', [dashboardkepalatokoController::class, 'index']);
Route::get('/DashboardKepalaToko', [dashboardkepalatokoController::class, 'index']);

Route::get('/stok-barang-kepalatoko', [dashboardkepalatokoController::class, 'stock'])->name('stok.kepalatoko');
Route::get('/stokkepalatoko', [dashboardkepalatokoController::class, 'stock']);

Route::get('/profile-kepalatoko', [profilekepalatokoController::class, 'index'])->name('profile.kepalatoko.index');
Route::get('/profilekepalatoko', [profilekepalatokoController::class, 'index']);

Route::post('/profile-kepalatoko/update-profile', [profilekepalatokoController::class, 'updateProfile'])->name('profile.kepalatoko.updateProfile');
Route::post('/profile-kepalatoko/update-password', [profilekepalatokoController::class, 'updatePassword'])->name('profile.kepalatoko.updatePassword');
Route::post('/profile-kepalatoko/update', [profilekepalatokoController::class, 'updateProfile']);

Route::get('/report-kepalatoko', [ReportkepalatokoController::class, 'index'])->name('report.kepalatoko');

Route::get('/Reportkepalatoko', [ReportkepalatokoController::class, 'index']);

Route::patch('/report/approve/{id}', [ReportkepalatokoController::class, 'approve'])->name('report.approve');
Route::patch('/report/reject/{id}', [ReportkepalatokoController::class, 'reject'])->name('report.reject');
Route::post('/report/approve/{id}', [ReportkepalatokoController::class, 'approve']);
Route::post('/report/reject/{id}', [ReportkepalatokoController::class, 'reject']);

// ==========================================
// 4. HALAMAN PETUGAS GUDANG (GUDANGCONTROLLER & PROFIL)
// ==========================================
// Dashboard Kasir
Route::get('/HalamanDepanKasir', function () {
    $featuredProduct = Product::where('status', 'approved')
        ->where('stock', '>', 0)
        ->latest()
        ->take(6)
        ->get();

    return view('HalamanDepanKasir', compact('featuredProduct'));
})->name('dashboard.kasir');

Route::get('/shop', [ShopController::class, 'index'])->name('halaman.shop');
Route::get('/HalamanShop', [ShopController::class, 'index']);

// Kelola Gudang & Stok Kritis
Route::get('/dashboard-gudang', [GudangController::class, 'dashboard'])->name('dashboard.gudang');
Route::get('/DashboardGudang', [GudangController::class, 'dashboard']);
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
        'password' => ['required', 'confirmed', Password::min(8)],
    ], [
        'current_password.required' => 'Kata sandi saat ini wajib diisi.',
        'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
        'password.required' => 'Kata sandi baru wajib diisi.',
        'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        'password.min' => 'Kata sandi baru minimal 8 karakter.',
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

// CRUD & Manajamen Produk (Hapus, Update Harga, Edit, Update)
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{id}/update-price', [ProductController::class, 'updatePrice'])->name('products.updatePrice');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// ==========================================
// 5. KATALOG, SHOP & PEMBAYARAN
// ==========================================
Route::get('/HalamanShop', [ShopController::class, 'index'])->name('halaman.shop');
Route::get('/HalamanKeranjang', function () {
    return view('HalamanKeranjang');
});

Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');

// Pembayaran & Transaksi
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/halamanpembayaran', [PembayaranController::class, 'index']);
Route::post('/pembayaran/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses');

Route::get('/berhasil', [PembayaranController::class, 'berhasil'])->name('pembayaran.berhasil');

Route::get('/riwayat-transaksi', [PembayaranController::class, 'riwayat'])->name('riwayat.transaksi');
Route::get('/Riwayattransaksi', [PembayaranController::class, 'riwayat']);

Route::get('/transaksi', function () {
    return view('transaksi');
});

// ==========================================
// 6. ROUTE KEPALA TOKO, MANAJEMEN & PROFILE
// ==========================================

// Profil Kepala Toko
Route::get('/profilekepalatoko', [profilekepalatokoController::class, 'index']);
Route::post('/profilekepalatoko/update', [profilekepalatokoController::class, 'updateProfile']);

// Report Kepala Toko (Laporan & Konfirmasi Persetujuan)
Route::get('/Reportkepalatoko', [ReportkepalatokoController::class, 'index'])->name('report.kepalatoko');

Route::get('/ManajemenKaryawan', function () {
    return view('ManajemenKaryawan');
});

Route::get('/HalamanInformasiAkun', function () {
    return view('HalamanInformasiAkun');
});

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

// Keamanan Akun
Route::get('/HalamanKeamananAkun', [PasswordController::class, 'index'])->name('keamanan.index');
Route::match(['post', 'put'], '/HalamanKeamananAkun', [PasswordController::class, 'update'])->name('keamanan.update');

Route::get('/bantuan-kasir', function () {
    return view('BantuanKasir');
})->name('bantuan.kasir');

// ROUTE LAPORAN INDEX
Route::get('/report-index', [ReportkepalatokoController::class, 'index'])->name('report.index');
Route::get('/ReportIndex', [ReportkepalatokoController::class, 'index']);

// ROUTE DIPROTEKSI AUTHENTICATION
Route::middleware(['auth'])->group(function () {
    Route::get('/kepalatoko/home', [dashboardkepalatokoController::class, 'index'])->name('kepalatoko.home');
    Route::get('/kepalatoko/stock', [dashboardkepalatokoController::class, 'stock'])->name('kepalatoko.stock');
    Route::get('/kepalatoko/orders', [dashboardkepalatokoController::class, 'orders'])->name('kepalatoko.orders');
    Route::get('/kepalatoko/staff', [dashboardkepalatokoController::class, 'staff'])->name('kepalatoko.staff');
});

Route::get('/HalamanInformasiAkun', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/BantuanKasir', function () {
    return view('BantuanKasir');
});
