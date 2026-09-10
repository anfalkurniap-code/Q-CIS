<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GudangController extends Controller
{
    // 1. Halaman Dashboard Gudang
    public function dashboard()
    {
        // Mengambil semua produk yang sudah approved
        $products = Product::where('status', 'approved')->latest()->get();

        // Total SKU yang sudah approved
        $totalSku = $products->count();

        // Barang stok kritis (stok <= 10 dan status approved)
        $stokKritisItems = Product::where('status', 'approved')
            ->where('stock', '<=', 10)
            ->get();

        $stokKritisCount = $stokKritisItems->count();

        // Barang Masuk Hari Ini (Diurutkan dari yang terbaru)
        // Disamakan nama variabelnya menjadi $barangHariIni agar sesuai dengan tampilan Blade
        $barangHariIni = Product::where('status', 'approved')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->get();

        // Fallback: Jika belum ada barang masuk hari ini, tampilkan 5 produk approved terbaru
        if ($barangHariIni->isEmpty()) {
            $barangHariIni = $products->take(5);
        }

        $totalBarangMasukHariIni = $barangHariIni->count();

        return view('Dashboardgudang', compact(
            'products',
            'totalSku',
            'stokKritisCount',
            'stokKritisItems',
            'barangHariIni',
            'totalBarangMasukHariIni'
        ));
    }

    // 2. Halaman Kelola Gudang
    public function kelola(Request $request)
    {
        $query = Product::where('status', 'approved');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $query->latest()->get();

        $totalSku = Product::where('status', 'approved')->count();
        $stokKritisCount = Product::where('status', 'approved')->where('stock', '<=', 10)->count();

        return view('kelolagudang', compact('products', 'totalSku', 'stokKritisCount'));
    }

    // 3. Halaman Stok Kritis
    public function kritis()
    {
        $itemsKritis = Product::where('status', 'approved')
            ->where('stock', '<=', 10)
            ->latest()
            ->get();

        $stokKritisCount = $itemsKritis->count();

        return view('stok-kritis', compact('itemsKritis', 'stokKritisCount'));
    }

    // 4. Halaman Riwayat Gudang
    public function riwayat()
    {
        $riwayatProduk = Product::latest()->get();

        return view('Riwayatgudang', compact('riwayatProduk'));
    }

    // 5. Simpan Barang Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer',
            'expired_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'purchase_price' => $request->purchase_price,
            'stock' => $request->stock,
            'expired_date' => $request->expired_date,
            'status' => 'pending',
        ]);

        return redirect()->route('kelola.gudang')->with('success', 'Pengajuan barang berhasil dikirim! Menunggu persetujuan Kepala Toko.');
    }
}
