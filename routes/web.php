<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/loginKasir', function () {
    return view('loginKasir');
});
Route::get('/TampilanAwalLogin', function(){
    return view('TampilanAwalLogin');
});