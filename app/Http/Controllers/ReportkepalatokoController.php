<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ReportkepalatokoController extends Controller
{
    // Menampilkan Halaman Laporan & Konfirmasi
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Product::with('category');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Ambil produk dan urutkan dari yang terbaru (paling atas)
        $barangMasuk = $query->latest()->get();

        return view('Reportkepalatoko', compact('barangMasuk'));
    }

    // Aksi untuk Menyetujui Barang (Approve)
    public function approve($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Barang berhasil disetujui dan masuk ke stok toko!');
    }

    // Aksi untuk Menolak Barang (Reject)
    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Pengajuan barang ditolak.');
    }
}