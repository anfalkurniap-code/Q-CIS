<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/belajar', function () {
    return view('belajar');
});

Route::get('/dashboard', function () {
    return 'Halo Tio, Route Dashboard Aman!';
});