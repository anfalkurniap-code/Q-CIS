<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilGudangController extends Controller
{
    /**
     * Menampilkan Halaman Profil Gudang
     */
    public function index()
    {
        $user = Auth::user();
        return view('profil-gudang', compact('user'));
    }

    /**
     * Memperbarui Data Profil Gudang
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Memproses Perubahan Password Gudang
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'current_password.required'         => 'Kata sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
            'password.required'                 => 'Kata sandi baru wajib diisi.',
            'password.confirmed'                => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.min'                      => 'Kata sandi baru minimal 8 karakter.',
        ]);

        // 2. Update Password Pengguna di Database
        $user = Auth::user();
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // 3. Redirect Kembali ke Halaman Profil Gudang
        return redirect()->route('profil.gudang')->with('success', 'Kata sandi berhasil diperbarui!');
    }
}