<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profilekepalatokoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user) {
            $user = User::where('role', 'kepala_toko')->first() ?? new User([
                'name' => 'Kepala Toko',
                'username' => 'kepalatoko',
                'email' => 'kepalatoko@smkmart.sch.id',
                'role' => 'kepala_toko',
            ]);
        }

        return view('profilekepalatoko', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            $user = User::where('role', 'kepala_toko')->first();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required' => 'Nama pengguna wajib diisi.',
            'avatar.image' => 'Berkas foto profil harus berupa gambar.',
            'avatar.mimes' => 'Format foto profil harus JPG, JPEG, atau PNG.',
            'avatar.max' => 'Ukuran foto profil maksimal 2MB.',
        ]);

        if ($user) {
            $user->name = $request->name;

            if ($request->filled('username')) {
                $user->username = $request->username;
            }

            if ($request->hasFile('avatar')) {
                // Hapus avatar lama jika ada
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                    Storage::disk('public')->delete($user->profile_pic);
                }

                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatarPath;
                $user->profile_pic = $avatarPath;
            }

            $user->save();
        }

        return redirect()->route('profile.kepalatoko.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            $user = User::where('role', 'kepala_toko')->first();
        }

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if ($user && $user->password) {
            if (! Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Kata sandi saat ini tidak sesuai.');
            }

            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('profile.kepalatoko.index')->with('success', 'Kata sandi berhasil diubah!');
    }

    public function update(Request $request)
    {
        return $this->updateProfile($request);
    }
}