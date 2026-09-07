<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GudangController extends Controller
{
    // 1. Halaman Dashboard Gudang
    public function dashboard()
    {
        // Hanya menghitung produk yang sudah disetujui (approved)
        $products = Product::where('status', 'approved')->get();
        
        // Total SKU / Jenis Barang yang sudah disetujui
        $totalSku = $products->count();

        // Barang stok kritis (stok <= 5 dan sudah approved)
        $stokKritisItems = Product::where('status', 'approved')
            ->where('stock', '<=', 5)
            ->get();
        $stokKritisCount = $stokKritisItems->count();

        // Barang Masuk Hari Ini (hanya yang sudah approved)
        $barangMasukHariIni = Product::where('status', 'approved')
            ->whereDate('created_at', Carbon::today())
            ->get();
        $totalBarangMasukHariIni = $barangMasukHariIni->count();

        // 💡 UBAH DI SINI: Sesuaikan dengan nama file .blade.php kamu di folder resources/views/
        // Jika nama filenya dashboardgudang.blade.php, gunakan 'dashboardgudang'
        return view('Dashboardgudang', compact(
            'products',
            'totalSku', 
            'stokKritisCount', 
            'stokKritisItems', 
            'barangMasukHariIni',
            'totalBarangMasukHariIni'
        ));
    }

    // 2. Halaman Kelola Gudang
    public function kelola(Request $request)
    {
        // Fitur pencarian barang jika ada input search
        $query = Product::where('status', 'approved');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Hanya tampilkan produk yang sudah diapprove Kepala Toko
        $products = $query->latest()->get();
        
        $totalSku = Product::where('status', 'approved')->count();
        $stokKritisCount = Product::where('status', 'approved')->where('stock', '<=', 5)->count();

        return view('kelolagudang', compact('products', 'totalSku', 'stokKritisCount'));
    }

    // 3. Halaman Stok Kritis
    public function kritis()
    {
        // Mengambil produk yang disetujui dengan stok <= 5
        $itemsKritis = Product::where('status', 'approved')
            ->where('stock', '<=', 5)
            ->get();
        $stokKritisCount = $itemsKritis->count();

        return view('stokkritis', compact('itemsKritis', 'stokKritisCount'));
    }

    // 4. Halaman Riwayat Gudang
    public function riwayat()
    {
        // Riwayat menampilkan semua produk beserta status persetujuannya (pending/approved/rejected)
        $riwayatProduk = Product::latest()->get();

        return view('Riwayatgudang', compact('riwayatProduk'));
    }

    // 5. Simpan Barang Baru (Penginputan oleh Staf Gudang)
    public function store(Request $request)
    {
        // Validasi input form dari Gudang
        $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'stock'          => 'required|integer',
            'expired_date'   => 'nullable|date',
            'description'    => 'nullable|string',
        ]);

        // Simpan data dengan status default 'pending'
        Product::create([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => Str::slug($request->name),
            'description'    => $request->description,
            'price'          => $request->price,
            'purchase_price' => $request->purchase_price,
            'stock'          => $request->stock,
            'expired_date'   => $request->expired_date,
            'status'         => 'pending', // Menunggu persetujuan Kepala Toko
        ]);

        return redirect()->route('kelola.gudang')->with('success', 'Pengajuan barang berhasil dikirim! Menunggu persetujuan Kepala Toko.');
    }
}