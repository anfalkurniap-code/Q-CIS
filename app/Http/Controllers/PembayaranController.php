<?php

namespace App\Http\Controllers;

use App\Models\Product; // <--- 1. WAJIB IMPORT MODEL PRODUCT
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

        // =========================================================
        // 2. LOGIKA UTAMA: POTONG STOK DI DATABASE MYSQL
        // =========================================================
        if (is_array($cartItems)) {
            foreach ($cartItems as $item) {
                // Cari produk berdasarkan ID yang ada di keranjang
                $product = Product::find($item['id']);
                
                if ($product) {
                    // Kurangi kolom 'stok' di database sesuai qty yang dibeli
                    $product->decrement('stok', $item['qty']);
                }
            }
        }

        // =========================================================
        // 3. SIMPAN SESSION UNTUK HALAMAN STRUK & RIWAYAT
        // =========================================================
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

        // Simpan data transaksi saat ini ke session
        session($transaksiBaru);

        // Tambahkan ke riwayat transaksi
        $riwayat = session()->get('riwayat_transaksi', []);
        array_unshift($riwayat, $transaksiBaru);
        session(['riwayat_transaksi' => $riwayat]);

        return redirect()->route('pembayaran.berhasil');
    }
}