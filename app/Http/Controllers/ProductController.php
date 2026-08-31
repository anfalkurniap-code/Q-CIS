<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $suppliers  = class_exists(Supplier::class) ? Supplier::all() : collect();

        return view('inputbarang', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan persis dengan attribute name di Form HTML
        $request->validate([
            'barcode'        => 'nullable|string|max:100',
            'product_name'   => 'required|string|max:255', // Validasi product_name
            'category_id'    => 'required',
            'expired_date'   => 'required|date',
            'stock'          => 'required|integer|min:1',
            'supplier_id'    => 'nullable',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0', // Validasi selling_price
            'receipt_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            // Pesan error kustom (Opsional)
            'product_name.required' => 'Nama barang wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
            'category_id.required'  => 'Kategori barang wajib dipilih.',
            'expired_date.required' => 'Tanggal kadaluarsa wajib diisi.',
        ]);

        // Upload foto resi/nota jika ada
        $imagePath = null;
        if ($request->hasFile('receipt_image')) {
            $imagePath = $request->file('receipt_image')->store('receipts', 'public');
        }

        // Simpan data ke database
        Product::create([
            'barcode'        => $request->barcode,
            'name'           => $request->product_name,   // Memetakan product_name ke kolom 'name' DB
            'category_id'    => $request->category_id,
            'expired_date'   => $request->expired_date,
            'stock'          => $request->stock,
            'supplier_id'    => $request->supplier_id,
            'purchase_price' => $request->purchase_price ?? 0,
            'price'          => $request->selling_price,  // Memetakan selling_price ke kolom 'price' DB
            'receipt_image'  => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Data barang baru berhasil disimpan!');
    }
}