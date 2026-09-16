<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Menampilkan daftar produk ke halaman Shop / Kasir
     */
    public function index(Request $request)
    {
        // Query produk dari database
        $query = Product::where('status', 'approved')
            ->where('stock', '>', 0);

        // Fitur pencarian barang
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Ambil data produk terbaru
        $products = $query->latest()->get();

        // KATEGORI STATIS (Agar tidak error Query/Database Exception)
        $categories = collect([
            (object)['id' => 1, 'name' => 'Minuman', 'slug' => 'minuman'],
            (object)['id' => 2, 'name' => 'Makanan', 'slug' => 'makanan'],
            (object)['id' => 3, 'name' => 'Alat Tulis', 'slug' => 'alat-tulis'],
            (object)['id' => 4, 'name' => 'Seragam', 'slug' => 'seragam'],
        ]);

        // Kirim ke view
        return view('HalamanShop', compact('products', 'categories'));
    }
}