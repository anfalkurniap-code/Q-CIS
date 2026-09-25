<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        // 'pendaftaran' di sini mengarah ke file resources/views/pendaftaran.blade.php
        return view('pendaftaran'); 
    }
}