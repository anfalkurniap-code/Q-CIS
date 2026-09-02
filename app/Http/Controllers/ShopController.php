<?php

namespace App\Http\Controllers;

use App\Models\Product; // Memanggil Model Product
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Menampilkan daftar produk asli dari database ke halaman Shop
     */
    public function index()
    {
        // Ambil semua data produk yang ada di database
        $products = Product::all();

        // Kirim variabel $products ke view 'shop'
        return view('HalamanShop', compact('products'));
    }
}