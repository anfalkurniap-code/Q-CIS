<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create()
    {
        return view('inputbarang');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'product_name'  => 'required|string|max:255',
            'current_stock' => 'required|integer|min:1',
            'selling_price' => 'required|numeric|min:0',
        ]);

        // 2. Direct Insert ke database phpMyAdmin tanpa lewat Model
        DB::table('products')->insert([
            'name'        => $request->product_name,
            'slug'        => Str::slug($request->product_name) . '-' . time(),
            'description' => $request->product_name,
            'price'       => $request->selling_price,
            'stock'       => $request->current_stock,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->back()->with('success', 'Data barang berhasil disimpan ke database!');
    }
}