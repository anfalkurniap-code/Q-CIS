<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function proses(Request $request)
    {
        // Validasi data input dari form pembayaran
        $request->validate([
            'cart_data'      => 'required',
            'payment_method' => 'required|string',
            'subtotal'       => 'required|numeric',
            'discount'       => 'required|numeric',
            'total_price'    => 'required|numeric',
            'cash_amount'    => 'required|numeric|gte:total_price',
        ]);

        $cartItems = json_decode($request->input('cart_data'), true);

        // Potong stok di database MySQL
        if (is_array($cartItems)) {
            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                
                if ($product) {
                    $product->decrement('stok', $item['qty']);
                }
            }
        }

        // Simpan Session untuk Struk & Riwayat
        Carbon::setLocale('id');
        $transaksiBaru = [
            'trx_id'         => 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
            'cart_data'      => $cartItems,
            'payment_method' => $request->input('payment_method'),
            'subtotal'       => (float) $request->input('subtotal'),
            'discount'       => (float) $request->input('discount'),
            'total_price'    => (float) $request->input('total_price'),
            'cash_amount'    => (float) $request->input('cash_amount'),
            'waktu'          => Carbon::now()->translatedFormat('d M Y, H:i'),
            'kategori'       => 'PEMBAYARAN TUNAI',
        ];

        session($transaksiBaru);

        $riwayat = session()->get('riwayat_transaksi', []);
        array_unshift($riwayat, $transaksiBaru);
        session(['riwayat_transaksi' => $riwayat]);

        return redirect()->route('pembayaran.berhasil');
    }

    // Method untuk menampilkan halaman riwayat transaksi
    public function riwayat()
    {
        $riwayat = session()->get('riwayat_transaksi', []);

        return view('Riwayattransaksi', compact('riwayat'));
    }

    // Method untuk menampilkan struk / halaman berhasil
    public function berhasil()
    {
        return view('berhasil');
    }
}