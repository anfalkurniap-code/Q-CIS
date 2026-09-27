<?php

namespace App\Http\Controllers;

class PendaftaranController extends Controller
{
    public function index()
    {
        // 'pendaftaran' di sini mengarah ke file resources/views/pendaftaran.blade.php
        return view('pendaftaran');
    }
}
