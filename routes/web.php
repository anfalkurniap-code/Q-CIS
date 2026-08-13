<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\AuthGudangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\dashboardkepalatokoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoginKepalaTokoController;

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

// Callback Penanganan Data Dashboard Gudang (Dinamis dari Database)
$gudangDashboardData = function () {
    $totalSku = DB::table('products')->count();
    $stokKritisCount = DB::table('products')->where('stock', '<=', 5)->count();

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

// Route Kelola Gudang (Dinamis dari Database)
Route::get('/kelola-gudang', function () {
    $totalSku = DB::table('products')->count();
    $stokKritisCount = DB::table('products')->where('stock', '<=', 5)->count();

    // Mengambil semua data produk dari database
    $items = DB::table('products')->orderBy('id', 'desc')->get();

    return view('kelolagudang', compact('totalSku', 'stokKritisCount', 'items'));
})->name('kelola.gudang');

Route::get('/profil-gudang', function () {
    return view('ProfilGudang');
})->name('profil.gudang');

Route::get('/ubah-password-gudang', function () {
    return view('UbahPaswordGudang');
})->name('password.gudang.change');

// Route Input Barang (Gudang)
Route::get('/input-barang', [ProductController::class, 'create'])->name('input.barang');
Route::post('/input-barang', [ProductController::class, 'store'])->name('products.store');

// Route Stok Kritis (Dinamis dari Database - Disesuaikan dengan stokkritis.blade.php)
Route::get('/stok-kritis', function () {
    $itemsKritis = DB::table('products')
        ->where('stock', '<=', 5)
        ->orderBy('stock', 'asc')
        ->get();

    $stokKritisCount = $itemsKritis->count();

    // Mengarahkan ke file view stokkritis.blade.php dengan variabel $itemsKritis dan $stokKritisCount
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

Route::get('/laporan-stok', function () {
    return view('LaporanStokAkhir');
});

Route::get('/HalamanProfile', function () {
    return view('HalamanProfile');
});

// Transaksi Controller Routes
Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');
Route::get('/pembayaran', [TransactionController::class, 'pembayaran'])->name('pembayaran');
Route::post('/pembayaran/proses', [TransactionController::class, 'proses'])->name('pembayaran.proses');
Route::get('/pembayaran/berhasil', [TransactionController::class, 'pembayaran.berhasil']);


// ==========================================
// 5. ROUTE DASHBOARD KEPALA TOKO & PROFILE
// ==========================================
Route::get('/dashboardkepalatoko', function () {
    $lowStockItems = DB::table('products')
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

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/HalamanKeamananAkun', function () {
    return view('HalamanKeamananAkun');
});

Route::get('/BantuanKasir', function () {
    return view('BantuanKasir');
});

//route reportindex
Route::get('/ReportIndex', [ReportController::class, 'index']);


// Halaman Form Login
Route::get('/LoginKepalaToko', [LoginKepalaTokoController::class, 'showLoginForm'])->name('login.kepalatoko');
Route::post('/LoginKepalaToko', [LoginKepalaTokoController::class, 'login']);

// Route untuk menampilkan halaman login kepala toko
Route::get('/LoginKepalaToko', function () {
    return view('LoginKepalaToko'); // Pastikan nama file blade-nya selaras (LoginKepalaToko.blade.php)
});