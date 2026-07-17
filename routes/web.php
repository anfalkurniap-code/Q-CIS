<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loginkasir', function () {
    return view('loginkasir');
});

Route::get('/Tampilanawallogin', function () {
    return view('Tampilanawallogin');
}); 

Route::get('/katalog', function () {
    return view('katalog');
})->name('katalog');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');