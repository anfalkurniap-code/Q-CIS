<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportkepalatokoController extends Controller
{
    /**
     * Menampilkan Halaman Laporan & Konfirmasi Barang Masuk
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $date = $request->input('date');

        $query = BarangMasuk::query();

        if ($search) {
            $query->where('nama_barang', 'like', "%{$search}%");
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $barangMasuk = $query->latest()->get();

        return view('Reportkepalatoko', compact('barangMasuk'));
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
