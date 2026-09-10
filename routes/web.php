<?php

use App\Http\Controllers\AuthGudangController;
use App\Http\Controllers\AuthKasirController;
<<<<<<< Updated upstream
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LoginKepalaTokoController;
use App\Http\Controllers\ProductController;
=======
use App\Http\Controllers\dashboardkepalatokoController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LoginKepalaTokoController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
>>>>>>> Stashed changes
use App\Http\Controllers\profilekepalatokoController;
use App\Http\Controllers\ProfilGudangController;
use App\Http\Controllers\ReportkepalatokoController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
<<<<<<< Updated upstream
use App\Models\Product;
use Illuminate\Support\Facades\Route;
=======
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
Route::get('/manajemen-karyawan', function () {
    return view('ManajemenKaryawan');
})->name('manajemen.karyawan');

// ------------------------------------------
// B. AREA KASIR & SHOP
// ------------------------------------------
=======
// ==========================================
// 4. HALAMAN PETUGAS GUDANG (GUDANGCONTROLLER & PROFIL)
// ==========================================
// Dashboard Kasir
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
Route::get('/keranjang', function () {
    return view('HalamanKeranjang');
})->name('keranjang');
=======
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

// ==========================================
// 5. KATALOG, SHOP & PEMBAYARAN
// ==========================================
Route::get('/HalamanShop', [ShopController::class, 'index'])->name('halaman.shop');
>>>>>>> Stashed changes
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
});

// ==========================================
// 6. ROUTE KEPALA TOKO, MANAJEMEN & PROFILE
// ==========================================
Route::get('/dashboardkepalatoko', function () {
    $today = Carbon::today();

    // 1. Uang Masuk: Total transaksi penjualan hari ini (tabel transactions)
    $uang_masuk = DB::table('transactions')
        ->whereDate('created_at', $today)
        ->sum('total_price') ?? 0;

    // 2. Uang Keluar: Total biaya pengadaan stok barang hari ini (tabel products: purchase_price * stock)
    $uang_keluar = DB::table('products')
        ->whereDate('created_at', $today)
        ->selectRaw('SUM(purchase_price * stock) as total_keluar')
        ->value('total_keluar') ?? 0;

    // 3. Laba / Rugi: Selisih Uang Masuk dikurangi Uang Keluar
    $laba_rugi = $uang_masuk - $uang_keluar;

    // 4. Data produk dengan stok kritis (kurang dari atau sama dengan 5)
    $lowStockItems = DB::table('products')
        ->where('status', 'approved')
        ->where('stock', '<=', 5)
        ->get();

    // 5. Tren Penjualan Dinamis 7 Hari Terakhir dari Database
    $sales_trend = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $dayName = $date->format('D'); // Format: Mon, Tue, Wed, Thu, Fri, Sat, Sun

        $totalPenjualanHarian = DB::table('transactions')
            ->whereDate('created_at', $date)
            ->sum('total_price') ?? 0;

        $sales_trend[$dayName] = (float) $totalPenjualanHarian;
    }

    return view('dashboardkepalatoko', [
        'uang_masuk' => $uang_masuk,
        'uang_keluar' => $uang_keluar,
        'laba_rugi' => $laba_rugi,
        'today_sales' => $uang_masuk,
        'sales_growth' => 12,
        'active_orders' => DB::table('transactions')->whereDate('created_at', $today)->count(),
        'processing_orders' => 18,
        'ready_pickup_orders' => 6,
        'low_stock_count' => $lowStockItems->count(),
        'low_stock_items' => $lowStockItems,
        'sales_trend' => $sales_trend,
        'live_operations' => [
            [
                'user' => 'Budi',
                'action' => 'Restock Produk Minuman',
                'status' => 'Success',
                'status_color' => 'bg-emerald-100 text-[#064e3b]',
            ],
            [
                'user' => 'Siti',
                'action' => 'Memproses Pesanan #1042',
                'status' => 'Pending',
                'status_color' => 'bg-orange-100 text-orange-700',
            ],
            [
                'user' => 'Joko',
                'action' => 'Update Harga Barang',
                'status' => 'Success',
                'status_color' => 'bg-emerald-100 text-[#064e3b]',
            ],
        ],
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
