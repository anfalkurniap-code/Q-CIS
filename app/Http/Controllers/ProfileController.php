<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    // Fungsi bantuan agar data default selalu siap
    private function getUserData()
    {
        if (!session()->has('user_dummy')) {
            session([
                'user_dummy' => [
                    'name'   => 'Budi Santoso',
                    'email'  => 'budi.santoso@smk-qcis.sch.id',
                    'phone'  => '+62 812-3456-7890',
                    'class'  => 'XI',
                    'major'  => 'Rekayasa Perangkat Lunak',
                    'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300'
                ]
            ]);
        }

        return session('user_dummy');
    }

    // 1. HALAMAN UTAMA PROFIL
    public function index()
    {
        $user = $this->getUserData();
        return view('HalamanProfile', compact('user'));
    }

    // 2. HALAMAN FORM EDIT / INFORMASI AKUN
    public function edit()
    {
        $user = $this->getUserData();
        return view('HalamanInformasiAkun', compact('user'));
    }

    // 3. PROSES SIMPAN DATA & FOTO
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'   => 'nullable|string|max:255',
            'email'  => 'nullable|email|max:255',
            'phone'  => 'nullable|string|max:20',
            'class'  => 'nullable|string|max:50',
            'major'  => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $oldData = $this->getUserData();
        $avatarPath = $oldData['avatar'];

        // Upload Foto Profile
        if ($request->hasFile('avatar')) {
            $uploadFolder = public_path('uploads/avatars');
            
            // Buat folder jika belum ada
            if (!File::exists($uploadFolder)) {
                File::makeDirectory($uploadFolder, 0755, true);
            }

            $file = $request->file('avatar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadFolder, $fileName);
            $avatarPath = asset('uploads/avatars/' . $fileName);
        }

        // Simpan data baru ke session
        session([
            'user_dummy' => [
                'name'   => $request->input('name', $oldData['name']),
                'email'  => $request->input('email', $oldData['email']),
                'phone'  => $request->input('phone', $oldData['phone']),
                'class'  => $request->input('class', $oldData['class']),
                'major'  => $request->input('major', $oldData['major']),
                'avatar' => $avatarPath,
            ]
        ]);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}