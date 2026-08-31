<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profilekepalatokoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profilekepalatoko', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|min:6',
        ]);

        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Proses simpan gambar Base64 jika ada
        if ($request->filled('cropped_image_data')) {
            // Logika simpan gambar kamu...
        }

        $user->save();

        // PENTING: Gunakan redirect agar tidak terjadi duplikasi halaman!
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}