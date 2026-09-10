<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil utama
     */
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->role === 'kepala_toko') {
            return view('profilekepalatoko', compact('user'));
        }

        return view('HalamanProfile', compact('user'));
    }

    /**
     * Menampilkan halaman edit informasi profil
     */
    public function edit()
    {
        $user = Auth::user();

        return view('HalamanInformasiAkun', compact('user'));
    }

    /**
     * Memproses update data profil
     */
    public function update(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.($user?->id ?? 0),
            'phone' => 'nullable|string|max:20',
            'class' => 'nullable|string|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan ke session untuk dummy data jika user belum tersimpan di DB
        session([
            'user_dummy.name' => $request->name,
            'user_dummy.email' => $request->email,
            'user_dummy.phone' => $request->phone,
            'user_dummy.class' => $request->class,
            'user_dummy.major' => $request->input('major', 'Rekayasa Perangkat Lunak'),
        ]);

        // 2. Olah Upload Foto (Avatar) jika ada
        if ($request->hasFile('avatar')) {
            if ($user && $user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            if ($user) {
                $user->avatar = $avatarPath;
            }

            session(['user_dummy.avatar' => Storage::url($avatarPath)]);
        }

        // 3. Update Database jika user login
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
