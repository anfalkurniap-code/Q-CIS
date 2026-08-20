<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Hitung atau definisikan nilainya (contoh sementara)
        $gross_growth = 10; // atau isi sesuai kalkulasi data kamu

        // Jika ada variabel lain di view (seperti $gross_revenue), definisikan juga di sini:
        // $gross_revenue = 100000; 

        // 2. Kirim ke view menggunakan compact()
        return view('ReportIndex', compact('gross_growth'));
    }
}