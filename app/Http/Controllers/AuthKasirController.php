<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthKasirController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $input = $request->input('login');

        // 2. Deteksi apakah input berupa email atau username
        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Susun array credentials
        $credentials = [
            $fieldType => $input,
            'password'  => $request->password,
        ];

        // 4. Coba Autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Mengubah role menjadi huruf kecil dan menghapus spasi ekstra agar lebih aman
            $role = strtolower(trim($user->role ?? ''));

            // 5. Arahkan ke halaman sesuai role
            if ($role === 'kasir') {
                return redirect()->route('dashboard.kasir');
            } 
            
            if ($role === 'gudang') {
                return redirect()->route('dashboard.gudang');
            }

            // Jika role terisi hal lain, default lempar ke dashboard kasir
            return redirect()->route('dashboard.kasir');
        }

        // Jika login gagal
        return back()->with('error', 'Email/Username atau Kata Sandi salah.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}