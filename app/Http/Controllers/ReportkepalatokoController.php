<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportkepalatokoController extends Controller
{
    /**
     * Menampilkan Halaman Laporan & Konfirmasi Barang (Masuk & Keluar)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $date = $request->input('date');
        $activeTab = $request->input('tab', 'masuk');

        $barangMasuk = collect();
        $barangKeluar = collect();

        if ($activeTab === 'keluar') {
            $queryKeluar = Transaction::with('details')->latest();

            if ($search) {
                $queryKeluar->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                        ->orWhereHas('details', function ($dq) use ($search) {
                            $dq->where('product_name', 'like', "%{$search}%");
                        });
                });
            }

            if ($date) {
                $queryKeluar->whereDate('created_at', $date);
            }

            $barangKeluar = $queryKeluar->get();
        } else {
            $queryMasuk = BarangMasuk::query();

            if ($search) {
                $queryMasuk->where('nama_barang', 'like', "%{$search}%");
            }

            if ($date) {
                $queryMasuk->whereDate('created_at', $date);
            }

            $barangMasuk = $queryMasuk->latest()->get();
        }

        return view('Reportkepalatoko', compact('barangMasuk', 'barangKeluar', 'activeTab'));
    }

    /**
     * Aksi untuk Menyetujui Barang (Approve)
     * Setelah disetujui, barang masuk ke tabel products (gudang & kasir).
     */
    public function approve($id)
    {
        $riwayat = BarangMasuk::findOrFail($id);

        // Cegah approval ganda
        if ($riwayat->status === 'approved') {
            return redirect()->back()->with('error', 'Barang ini sudah disetujui sebelumnya.');
        }

        // 1. Ubah status di tabel barang_masuks menjadi approved
        $riwayat->update(['status' => 'approved']);

        // 2. Periksa apakah produk dengan nama yang sama sudah ada di tabel products
        $product = Product::where('name', $riwayat->nama_barang)->first();

        if ($product) {
            // Jika produk sudah ada, tambahkan stoknya saja
            $product->increment('stock', $riwayat->jumlah);
            $product->update(['status' => 'approved']);
        } else {
            // Jika produk belum ada, buat produk baru dengan semua data dari barang_masuks
            Product::create([
                'barcode' => $riwayat->barcode,
                'name' => $riwayat->nama_barang,
                'slug' => Str::slug($riwayat->nama_barang).'-'.time(),
                'category_id' => $riwayat->category_id,
                'supplier_id' => $riwayat->supplier_id,
                'stock' => $riwayat->jumlah,
                'price' => $riwayat->harga ?? 0,
                'purchase_price' => $riwayat->purchase_price ?? 0,
                'expired_date' => $riwayat->expired_date,
                'image' => $riwayat->image,
                'receipt_image' => $riwayat->receipt_image,
                'status' => 'approved',
            ]);
        }

        return redirect()->back()->with('success', 'Barang berhasil disetujui! Stok gudang dan kasir telah diperbarui.');
    }

    /**
     * Aksi untuk Menolak Barang (Reject)
     */
    public function reject($id)
    {
        $riwayat = BarangMasuk::findOrFail($id);
        $riwayat->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Pengajuan barang ditolak.');
    }
}
