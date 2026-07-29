<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Simpan data input form sementara ke dalam session (tanpa database)
        session([
            'user_dummy' => [
                'name'  => $request->input('name', 'Budi Santoso'),
                'email' => $request->input('email', 'budi.santoso@smk-qcis.sch.id'),
                'phone' => $request->input('phone', '+62 812-3456-7890'),
                'class' => $request->input('class', 'XI'),
                'major' => $request->input('major', 'Rekayasa Perangkat Lunak'),
            ]
        ]);

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui! (Mode Simulasi Front-End)');
    }
}