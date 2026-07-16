<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD

Route::get('/belajar', function () {
    return view('belajar');
});

Route::get('/dashboard', function () {
    return 'Halo Tio, Route Dashboard Aman!';
=======
Route::get('/loginKasir', function () {
    return view('loginKasir');
});
Route::get('/TampilanAwalLogin', function(){
    return view('TampilanAwalLogin');
>>>>>>> 07a3824b7b11682a125de8ad0862fa4f70197576
});