<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    // 1. Halaman Dashboard Gudang
    public function dashboard()
    {
        $products = Product::all();
        
        // Total SKU / Jenis Barang di database
        $totalSku = $products->count();

        // Barang stok kritis (stok <= 5)
        $stokKritisItems = Product::where('stock', '<=', 5)->get();
        $stokKritisCount = $stokKritisItems->count();

        // Barang Masuk Hari Ini (filter berdasarkan tanggal dibuat hari ini)
        $barangMasukHariIni = Product::whereDate('created_at', Carbon::today())->get();
        $totalBarangMasukHariIni = $barangMasukHariIni->count();

        return view('dashboard.gudang', compact(
            'products',
            'totalSku', 
            'stokKritisCount', 
            'stokKritisItems', 
            'barangMasukHariIni',
            'totalBarangMasukHariIni'
        ));
    }

    // 2. Halaman Kelola Gudang
    public function kelola()
    {
        $products = Product::all();
        $totalSku = $products->count();
        $stokKritisCount = Product::where('stock', '<=', 5)->count();

        return view('kelolagudang', compact('products', 'totalSku', 'stokKritisCount'));
    }

    // 3. Halaman Stok Kritis
    public function kritis()
    {
        // Mengambil produk dengan stok <= 5
        $itemsKritis = Product::where('stock', '<=', 5)->get();
        $stokKritisCount = $itemsKritis->count();

        return view('stokkritis', compact('itemsKritis', 'stokKritisCount'));
    }

    // 4. Halaman Riwayat Gudang
    public function riwayat()
    {
        // Mengambil data produk/riwayat transaksi (diurutkan dari yang terbaru)
        $riwayatProduk = Product::latest()->get();

        // Mengirimkan variabel $riwayatProduk ke view Riwayatgudang
        return view('Riwayatgudang', compact('riwayatProduk'));
    }
}