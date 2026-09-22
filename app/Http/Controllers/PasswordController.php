<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Menampilkan Halaman Keamanan Akun
     */
    public function index()
    {
        return view('HalamanKeamananAkun');
    }

    /**
     * Memproses Perubahan Kata Sandi
     */
    public function update(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password_confirmation.required' => 'Konfirmasi kata sandi wajib diisi.',
        ]);

        // 2. Ambil user yang sedang aktif
        /** @var User|null $user */
        $user = Auth::user();

        // Fallback jika ada session user_id
        if (! $user && session('user_id')) {
            $user = User::find(session('user_id'));
        }

        // Fallback testing local jika belum login
        if (! $user) {
            $user = User::where('role', 'kasir')->first() ?? User::first();
            if ($user) {
                Auth::login($user);
            }
        }

        if (! $user) {
            return back()->withErrors(['current_password' => 'Pengguna tidak ditemukan. Silakan login terlebih dahulu.']);
        }

        // 3. Verifikasi kata sandi saat ini
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Kata sandi saat ini tidak sesuai.',
            ])->withInput();
        }

        // 4. Update kata sandi baru di database
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }
}
