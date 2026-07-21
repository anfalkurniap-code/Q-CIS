<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthKasirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/TampilanAwalLogin', function () {
    return view('TampilanAwalLogin');
});

Route::get('/loginKasir', function () {
    return view('loginKasir');
})->name('login');

Route::post('/loginKasir/proses', [AuthKasirController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {

Route::get('/HalamanDepanKasir', function () {
    return view('HalamanDepanKasir');
})->name('dashboard.kasir');

Route::post('/logoutKasir', [AuthKasirController::class, 'logout'])->name('logout');

});

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