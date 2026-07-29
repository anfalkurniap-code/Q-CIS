<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil
     */
    public function show()
    {
        $user = auth()->user();
        return view('profile', compact('user')); // Ganti 'profile' dengan nama file Blade kamu jika berbeda
    }

    /**
     * Memproses update data profil
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // 1. Validasi Input
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'  => 'nullable|string|max:20',
            'class'  => 'nullable|string|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // 2. Olah Upload Foto (Avatar) jika ada
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan foto baru ke folder 'public/avatars'
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // 3. Update Data Text
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->class = $request->class;
        $user->save();

        // 4. BALIK / REDIRECT KE HALAMAN PROFIL
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}