<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthGudangController extends Controller
{
    // Menampilkan halaman form login gudang
    public function showLoginForm()
    {
        // Sesuaikan dengan lokasi file view kamu tadi
        return view('auth.login-gudang');
    }

    // Memproses logika login gudang
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Tentukan field login (email atau username)
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Coba lakukan autentikasi
        if (Auth::attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']])) {
            // Jika berhasil, regenerasi session
            $request->session()->regenerate();

            // Alihkan ke dashboard gudang (ganti rute dashboard kamu)
            return redirect()->intended('/dashboard-gudang');
        }

        // 4. Jika gagal, kembali ke halaman login dengan error
        return back()->with('error', 'Email/Username atau password salah.');
    }
}