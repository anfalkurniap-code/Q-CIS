<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil
     */
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user(); 

        return view('profile', compact('user'));
    }

    /**
     * Memproses update ID, Password, dan Foto Profil
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // Validasi Input
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'cropped_image_data' => 'nullable|string'
        ]);

        // 1. Update Username / ID Kepala Toko
        $user->username = $request->input('username');

        // 2. Update Password (jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // 3. Update Foto Profil (Base64 dari Kamera/Galeri)
        if ($request->filled('cropped_image_data')) {
            $imageData = $request->input('cropped_image_data');

            // Ekstrak data base64
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, jpeg

                $imageData = base64_decode($imageData);

                if ($imageData !== false) {
                    // Hapus foto lama jika ada
                    if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                        Storage::disk('public')->delete($user->profile_pic);
                    }

                    // Simpan foto baru ke folder storage/app/public/profiles
                    $fileName = 'profiles/user_' . $user->id . '_' . time() . '.' . $type;
                    Storage::disk('public')->put($fileName, $imageData);

                    $user->profile_pic = $fileName;
                }
            }
        }

        // Simpan perubahan ke database
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}