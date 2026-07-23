<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function katalog()
    {
        return view('katalog');
    }


      public function pembayaran()
    {
         return view('halamanpembayaran');
    }

    public function proses(Request $request)
    {
        $trxId = 'TRX-' . rand(10000000, 99999999);
        $waktu = date('d M Y, H:i') . ' WIB';

        return redirect()->route('pembayaran.berhasil')->with([
            'trx_id' => $trxId,
            'waktu' => $waktu
        ]);
    }

    public function berhasil()
    {
        return view('berhasil');
    }
}