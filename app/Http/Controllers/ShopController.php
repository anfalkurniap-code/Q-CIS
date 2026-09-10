<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Menampilkan daftar produk asli dari database ke halaman Shop / Kasir
     */
    public function index(Request $request)
    {
        // Query hanya produk yang sudah disetujui (approved) dan stok > 0
        $query = Product::where('status', 'approved')
            ->where('stock', '>', 0);

        // Fitur pencarian barang jika Kasir mencari nama produk
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Ambil data produk terbaru
        $products = $query->latest()->get();
        // dd($products);

        // Kirim variabel $products dan $categories ke view 'HalamanShop'
        return view('HalamanShop', compact('products', 'categories'));
    }
}
