<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan form input barang
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers  = class_exists(Supplier::class) ? Supplier::all() : collect();

        return view('inputbarang', compact('categories', 'suppliers'));
    }

    /**
     * Simpan data barang baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barcode'        => 'nullable|string|max:100',
            'product_name'   => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'expired_date'   => 'required|date',
            'stock'          => 'required|integer|min:1',
            'supplier_id'    => 'nullable',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'receipt_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'product_name.required'  => 'Nama barang wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
            'category_id.required'   => 'Kategori barang wajib dipilih.',
            'category_id.exists'     => 'Kategori yang dipilih tidak valid.',
            'expired_date.required'  => 'Tanggal kadaluarsa wajib diisi.',
            'stock.required'         => 'Jumlah stok wajib diisi.',
        ]);

        // Upload foto resi/nota jika ada
        $imagePath = null;
        if ($request->hasFile('receipt_image')) {
            $imagePath = $request->file('receipt_image')->store('receipts', 'public');
        }

        // Simpan data barang ke database
        Product::create([
           // 'barcode'        => $request->barcode,//
            'name'           => $request->product_name,
            'category_id'    => $request->category_id,
            'expired_date'   => $request->expired_date,
            'stock'          => $request->stock,
            'supplier_id'    => $request->supplier_id,
            'purchase_price' => $request->purchase_price ?? 0,
            'price'          => $request->selling_price,
            'receipt_image'  => $imagePath,
        ]);

        return redirect()->route('kelola.gudang')->with('success', 'Data barang baru berhasil disimpan!');
    }

    /**
     * Update harga jual barang (Sesuai Route `products.updatePrice`)
     */
    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Harga jual berhasil diperbarui!');
    }

    /**
     * Hapus barang dari database (Sesuai Route `products.destroy`)
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus foto resi jika ada di storage
        if ($product->receipt_image && Storage::disk('public')->exists($product->receipt_image)) {
            Storage::disk('public')->delete($product->receipt_image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }
}