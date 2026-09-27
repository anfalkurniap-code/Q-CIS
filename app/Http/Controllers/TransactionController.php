<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $trxId = 'TRX-'.rand(10000000, 99999999);
        $waktu = date('d M Y, H:i').' WIB';

        return redirect()->route('pembayaran.berhasil')->with([
            'trx_id' => $trxId,
            'waktu' => $waktu,
        ]);
    }

    public function berhasil()
    {
        return view('berhasil');
    }

    // Menampilkan detail transaksi berdasarkan ID
    public function show($id = null)
    {
        $transaksi = $id
            ? Transaction::with('details')->findOrFail($id)
            : Transaction::with('details')->latest()->firstOrFail();

        return view('Ringkasanpesanan', compact('transaksi'));
    }
}
