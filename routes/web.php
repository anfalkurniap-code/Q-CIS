<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\dashboardkepalatokoController;
use App\Http\Controllers\ProfileController; // <-- DITAMBAHKAN DI SINI


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
// 2. AUTHENTICATION (LOGIN & LOGOUT)
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

Route::post('/LoginGudang/proses', [AuthKasirController::class, 'login'])->name('login.gudang.post');

// Route Logout
Route::post('/logout', [AuthKasirController::class, 'logout'])->name('logout');


// ==========================================
// 3. HALAMAN PETUGAS KASIR & GUDANG
// ==========================================
// Kasir
Route::get('/HalamanDepanKasir', function () {
    return view('HalamanDepanKasir');
})->name('dashboard.kasir');

<<<<<<< HEAD
// Gudang Dashboard (Sudah diperbaiki dengan membawa data variabel ke view)
Route::get('/HalamanDepanGudang', function () {
    $totalSku = "1,284";
    $stokKritisCount = 24;

    $items = [
        [
            'sku' => '#SKU-88291-B',
            'nama' => 'Piston Ring Set 4D56',
            'kategori' => 'Suku Cadang',
            'stok' => 5,
            'satuan' => 'Pcs',
            'status' => 'KRITIS',
            'lokasi' => 'Rak A-02',
            'is_kritis' => true
        ],
        [
            'sku' => '#SKU-18293-C',
            'nama' => 'Shell Helix HX7 10W-40',
            'kategori' => 'Pelumas',
            'stok' => 142,
            'satuan' => 'Ltr',
            'status' => 'TERSEDIA',
            'lokasi' => 'Rak B-12',
            'is_kritis' => false
        ],
        [
            'sku' => '#SKU-55410-T',
            'nama' => 'Bridgestone Dueler A/T',
            'kategori' => 'Ban',
            'stok' => 28,
            'satuan' => 'Unit',
            'status' => 'TERSEDIA',
            'lokasi' => 'Gudang Luar',
            'is_kritis' => false
        ],
        [
            'sku' => '#SKU-11984-E',
            'nama' => 'Pulpen Gel',
            'kategori' => 'Elektronik',
            'stok' => 132,
            'satuan' => 'Unit',
            'status' => 'TERSEDIA',
            'lokasi' => 'Rak E-05',
            'is_kritis' => false
        ],
    ];

    return view('DashboardGudang', compact('totalSku', 'stokKritisCount', 'items'));
})->name('dashboard.gudang');

// Route Kelola Gudang
Route::get('/kelola-gudang', function () {
    $totalSku = "1,284";
    $stokKritisCount = 24;

    $items = [
        [
            'sku' => '#SKU-88291-B',
            'nama' => 'Piston Ring Set 4D56',
            'kategori' => 'Suku Cadang',
            'stok' => 5,
            'satuan' => 'Pcs',
            'status' => 'KRITIS',
            'lokasi' => 'Rak A-02',
            'is_kritis' => true
        ],
        [
            'sku' => '#SKU-18293-C',
            'nama' => 'Shell Helix HX7 10W-40',
            'kategori' => 'Pelumas',
            'stok' => 142,
            'satuan' => 'Ltr',
            'status' => 'TERSEDIA',
            'lokasi' => 'Rak B-12',
            'is_kritis' => false
        ],
        [
            'sku' => '#SKU-55410-T',
            'nama' => 'Bridgestone Dueler A/T',
            'kategori' => 'Ban',
            'stok' => 28,
            'satuan' => 'Unit',
            'status' => 'TERSEDIA',
            'lokasi' => 'Gudang Luar',
            'is_kritis' => false
        ],
        [
            'sku' => '#SKU-11984-E',
            'nama' => 'Pulpen Gel',
            'kategori' => 'Elektronik',
            'stok' => 132,
            'satuan' => 'Unit',
            'status' => 'TERSEDIA',
            'lokasi' => 'Rak E-05',
            'is_kritis' => false
        ],
    ];

    return view('kelolagudang', compact('totalSku', 'stokKritisCount', 'items'));
})->name('kelola.gudang');

=======
// Gudang
Route::get('/HalamanDepanGudang', function () {
    return view('DashboardGudang');
})->name('dashboard.gudang');

>>>>>>> b988267 (menyelesaikan halaman informasi profile)
Route::get('/profil-gudang', function () {
    return view('ProfilGudang');
})->name('profil.gudang');

Route::get('/ubah-password-gudang', function () {
    return view('UbahPaswordGudang');
})->name('password.gudang.change');


// ==========================================
// 4. HALAMAN KATALOG / SHOP & TRANSAKSI
// ==========================================
Route::get('/HalamanShop', function () {
    $product = [
        [
            'nama' => 'Coca-cola Kaleng',
            'stok' => 24,
            'harga' => 6500,
            'kategori' => 'Minuman',
            'badge' => 'TERSEDIA',
            'warna_badge' => 'bg-emerald-400',
            'img' => 'https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=300'
        ],
        [
            'nama' => 'Lays Classic 68g',
            'stok' => 15,
            'harga' => 10500,
            'kategori' => 'Makanan Ringan',
            'badge' => 'TERSEDIA',
            'warna_badge' => 'bg-emerald-400',
            'img' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=300'
        ],
        [
            'nama' => 'Susu UHT 250ml',
            'stok' => 42,
            'harga' => 5500,
            'kategori' => 'Minuman',
            'badge' => 'TERSEDIA',
            'warna_badge' => 'bg-emerald-400',
            'img' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=300'
        ],
        [
            'nama' => 'Pulpen Faster C600',
            'stok' => 5,
            'harga' => 3500,
            'kategori' => 'Alat Tulis',
            'badge' => 'HAMPIR HABIS',
            'warna_badge' => 'bg-emerald-400',
            'img' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=300'
        ],
    ];

    return view('HalamanShop', ['products' => $product]);
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

// Transaksi Controller Routes
Route::get('/katalog', [TransactionController::class, 'katalog'])->name('katalog');
Route::get('/pembayaran', [TransactionController::class, 'pembayaran'])->name('pembayaran');
Route::post('/pembayaran/proses', [TransactionController::class, 'proses'])->name('pembayaran.proses');
Route::get('/pembayaran/berhasil', [TransactionController::class, 'berhasil'])->name('pembayaran.berhasil');


// ==========================================
// 5. ROUTE DASHBOARD KEPALA TOKO
// ==========================================
Route::get('/dashboardkepalatoko', function () {
    return view('dashboardkepalatoko', [
        'today_sales'         => 1450000,
        'sales_growth'        => 12,
        'active_orders'       => 24,
        'processing_orders'   => 18,
        'ready_pickup_orders' => 6,
        'low_stock_count'     => 5,
        'low_stock_items'     => [
            ['name' => 'Coca-cola Kaleng', 'status' => 'CRITICAL'],
            ['name' => 'Pulpen Faster C600', 'status' => 'WARNING'],
            ['name' => 'Susu UHT 250ml', 'status' => 'WARNING'],
            ['name' => 'Minyak Goreng 1L', 'status' => 'CRITICAL'],
            ['name' => 'Indomie Goreng', 'status' => 'WARNING'],
        ],
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
<<<<<<< HEAD
});
=======
});

Route::get('/HalamanInformasiAkun', function () {
    return view('HalamanInformasiAkun');
});

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
>>>>>>> b988267 (menyelesaikan halaman informasi profile)
