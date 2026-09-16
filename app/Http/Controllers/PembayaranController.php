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

    // 2. Menampilkan Halaman Riwayat Transaksi (Diambil dari Database)
    public function riwayat()
    {
        $riwayat = Transaction::orderBy('created_at', 'desc')->get();
        
        return view('Riwayattransaksi', compact('riwayat'));
    }

    // 3. Memproses dan Menyimpan Transaksi dari Form ke Database & Session Struk
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

                // B. Simpan item ke 'transaction_details' & potong stok
                foreach ($cartItems as $item) {
                    $productId = $item['id'] ?? null;
                    $qty       = $item['qty'] ?? $item['jumlah'] ?? 0;
                    $price     = $item['harga'] ?? $item['price'] ?? 0;
                    $name      = $item['nama'] ?? $item['name'] ?? 'Produk';

                    TransactionDetail::create([
                        'transaction_id' => $trx->id,
                        'product_id'     => $productId,
                        'product_name'   => $name,
                        'quantity'       => $qty,
                        'price'          => $price,
                        'subtotal'       => $price * $qty,
                    ]);

                    if ($productId) {
                        $product = Product::find($productId);
                        if ($product) {
                            $currentStock = $product->stock ?? $product->stok ?? 0;

                            if ($currentStock < $qty) {
                                throw new \Exception("Stok untuk produk '{$name}' tidak mencukupi!");
                            }

                            if (isset($product->stock)) {
                                $product->decrement('stock', $qty);
                            } else {
                                $product->decrement('stok', $qty);
                            }
                        }
                    }
                }

                return $trx;
            });

            // C. Simpan Session untuk Halaman Struk
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

            session($transaksiBaru);
            session()->forget('cart');

            return redirect()->route('pembayaran.berhasil')->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // 4. Method untuk Menampilkan Halaman Struk / Berhasil
    public function berhasil()
    {
        return view('berhasil');
    }
}