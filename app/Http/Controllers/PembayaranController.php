<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    // 1. Menampilkan Halaman Form Pembayaran
    public function index()
    {
        return view('halamanpembayaran');
    }

    // 2. Menampilkan Halaman Riwayat Transaksi
    public function riwayat()
    {
        $riwayat = Transaction::with('details')->orderBy('created_at', 'desc')->get();
        
        return view('Riwayattransaksi', compact('riwayat'));
    }

    // 3. Memproses dan Menyimpan Transaksi
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

        if (empty($cartItems) || !is_array($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong atau format salah!');
        }

        try {
            // Jalankan Database Transaction
            $transaksi = DB::transaction(function () use ($request, $cartItems) {
                
                // A. Simpan ke tabel 'transactions'
                $trx = Transaction::create([
                    'user_id'          => auth()->id() ?? null,
                    'invoice_number'   => 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
                    'total_price'      => (float) $request->input('total_price'),
                    'payment_method'   => $request->input('payment_method'),
                    'transaction_type' => 'PURCHASE',
                ]);

                // B. Simpan item ke 'transaction_details' & potong stok di database
                foreach ($cartItems as $item) {
                    $productId = $item['id'] ?? null;
                    $qty       = (int) ($item['qty'] ?? $item['jumlah'] ?? 0);
                    $nama      = $item['nama'] ?? $item['name'] ?? 'Produk Unregistered';
                    $harga     = (float) ($item['harga'] ?? $item['price'] ?? 0);

                    // Pastikan Product ada
                    if ($productId) {
                        $product = Product::find($productId);

                        if (!$product) {
                            throw new \Exception("Produk dengan ID {$productId} tidak ditemukan!");
                        }

                        // Cek kolom stok mana yang digunakan (stock atau stok)
                        $stokKolom = isset($product->stock) ? 'stock' : 'stok';
                        $stokSaatIni = $product->$stokKolom;

                        // Validasi kecukupan stok
                        if ($stokSaatIni < $qty) {
                            throw new \Exception("Stok untuk produk '{$nama}' tidak mencukupi! (Sisa: {$stokSaatIni})");
                        }

                        // Potong Stok
                        $product->decrement($stokKolom, $qty);
                    }

                    // Simpan Detail Transaksi
                    TransactionDetail::create([
                        'transaction_id' => $trx->id,
                        'product_id'     => $productId,
                        'product_name'   => $nama,
                        'quantity'       => $qty,
                        'price'          => $harga,
                        'subtotal'       => $harga * $qty,
                    ]);
                }

                return $trx;
            });

            // C. Simpan Session Rapi untuk Halaman Struk
            Carbon::setLocale('id');
            $transaksiBaru = [
                'trx_id'         => $transaksi->invoice_number,
                'cart_data'      => $cartItems,
                'payment_method' => $request->input('payment_method'),
                'subtotal'       => (float) $request->input('subtotal'),
                'discount'       => (float) $request->input('discount'),
                'total_price'    => (float) $request->input('total_price'),
                'cash_amount'    => (float) $request->input('cash_amount'),
                'waktu'          => Carbon::now()->translatedFormat('d M Y, H:i'),
                'kategori'       => 'PEMBAYARAN TUNAI',
            ];

            // Masukkan ke session 'last_transaction' agar aman dan tidak bentrok
            session(['last_transaction' => $transaksiBaru]);
            session()->forget('cart');

            return redirect()->route('pembayaran.berhasil')->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            // Jika ada error/stok kurang, transaksi dibatalkan (rollback) otomatis
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // 4. Method untuk Menampilkan Halaman Struk / Berhasil
    public function berhasil()
    {
        // Ambil data transaksi terakhir dari session
        $transaksi = session('last_transaction');

        if (!$transaksi) {
            return redirect()->route('pembayaran.index')->with('error', 'Tidak ada data transaksi.');
        }

        return view('berhasil', compact('transaksi'));
    }
}