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