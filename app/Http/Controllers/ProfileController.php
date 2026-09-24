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
        /** @var User $user */
        $user = Auth::user();

        // if ($user->role === 'kepala_toko') {
        //     return view('profilekepalatoko', compact('user'));
        // }

        return view('HalamanProfile', compact('user'));
    }

    /**
     * Menampilkan halaman edit informasi profil
     */
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('HalamanInformasiAkun', compact('user'));
    }

    /**
     * Memproses update data profil
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'class' => 'nullable|string|max:50',
            'major' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Olah Upload Foto (Avatar) jika ada
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. Update Data User di Database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->class = $request->class;
        $user->major = $request->input('major', 'Rekayasa Perangkat Lunak');
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
