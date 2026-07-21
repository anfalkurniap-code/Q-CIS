<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/belajar', function () {
    return view('belajar');
});

use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA / TAMPILAN AWAL
Route::get('/', function () {
    return view('TampilanAwalLogin');
});

Route::get('/TampilanAwalLogin', function () {
    return view('TampilanAwalLogin');
});


// 2. AUTHENTICATION (LOGIN & LOGOUT)
// Login Kasir
Route::get('/loginKasir', function () {
    return view('loginKasir');
})->name('login');

Route::post('/loginKasir/proses', [AuthKasirController::class, 'login'])->name('login.post');

// Login Gudang
Route::get('/LoginGudang', function () {
    return view('LoginGudang');
})->name('login.gudang');

// Route Logout
Route::post('/logout', [AuthKasirController::class, 'logout'])->name('logout');


// 3. AREA KHUSUS PETUGAS KASIR
Route::middleware(['auth'])->group(function () {
    Route::get('/HalamanDepanKasir', function () {
        // Pengecekan Hak Akses Kasir
        if (auth()->user()->role !== 'kasir') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk Kasir.');
        }
        return view('HalamanDepanKasir');
    })->name('dashboard.kasir');
});


// 4. AREA KHUSUS PETUGAS GUDANG
Route::middleware(['auth'])->group(function () {
    Route::get('/HalamanDepanGudang', function () {
        // Pengecekan Hak Akses Gudang
        if (auth()->user()->role !== 'gudang') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk Petugas Gudang.');
        }
        return view('dashboard');
    })->name('dashboard.gudang');
});


// 5. HALAMAN KATALOG / SHOP
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
});

Route::get('/halamanpembayaran', function () {
    return view('halamanpembayaran');
});

Route::get('/HalamanKeranjang', function () {
    return view('HalamanKeranjang');
});

