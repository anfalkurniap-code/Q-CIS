<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Tampilkan form input barang
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = class_exists(Supplier::class) ? Supplier::all() : collect();

        return view('inputbarang', compact('categories', 'suppliers'));
    }

    /**
     * Simpan data barang baru ke tabel barang_masuks dengan status pending.
     * Barang baru masuk ke produk (gudang & kasir) SETELAH disetujui Kepala Toko.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barcode' => 'nullable|string|max:100',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'expired_date' => 'required|date',
            'stock' => 'required|integer|min:1',
            'supplier_id' => 'nullable',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'product_name.required' => 'Nama barang wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
            'category_id.required' => 'Kategori barang wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'expired_date.required' => 'Tanggal kadaluarsa wajib diisi.',
            'stock.required' => 'Jumlah stok wajib diisi.',
            'image.image' => 'Berkas foto produk harus berupa gambar.',
            'image.max' => 'Ukuran foto produk maksimal 2MB.',
            'receipt_image.image' => 'Berkas resi harus berupa gambar.',
            'receipt_image.max' => 'Ukuran resi maksimal 2MB.',
        ]);

        // Upload foto produk
        $productImagePath = null;
        if ($request->hasFile('image')) {
            $productImagePath = $request->file('image')->store('products', 'public');
        }

        // Upload foto resi/nota
        $receiptImagePath = null;
        if ($request->hasFile('receipt_image')) {
            $receiptImagePath = $request->file('receipt_image')->store('receipts', 'public');
        }

        // Simpan ke tabel barang_masuks dengan status PENDING
        // Kepala Toko harus menyetujui sebelum barang masuk ke gudang & kasir
        BarangMasuk::create([
            'barcode' => $request->barcode,
            'nama_barang' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->stock,
            'harga' => $request->selling_price,
            'purchase_price' => $request->purchase_price ?? 0,
            'expired_date' => $request->expired_date,
            'image' => $productImagePath,
            'receipt_image' => $receiptImagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('kelola.gudang')->with('success', 'Data barang berhasil dikirim dan menunggu persetujuan Kepala Toko!');
    }

    /**
     * Tampilkan form edit barang
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers = class_exists(Supplier::class) ? Supplier::all() : collect();

        return view('editbarang', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update data barang secara keseluruhan
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'barcode' => 'nullable|string|max:100',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'expired_date' => 'required|date',
            'stock' => 'required|integer|min:0',
            'supplier_id' => 'nullable',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $productImagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($productImagePath && Storage::disk('public')->exists($productImagePath)) {
                Storage::disk('public')->delete($productImagePath);
            }
            $productImagePath = $request->file('image')->store('products', 'public');
        }

        $receiptImagePath = $product->receipt_image;
        if ($request->hasFile('receipt_image')) {
            if ($receiptImagePath && Storage::disk('public')->exists($receiptImagePath)) {
                Storage::disk('public')->delete($receiptImagePath);
            }
            $receiptImagePath = $request->file('receipt_image')->store('receipts', 'public');
        }

        $product->update([
            'barcode' => $request->barcode,
            'name' => $request->product_name,
            'slug' => Str::slug($request->product_name),
            'category_id' => $request->category_id,
            'expired_date' => $request->expired_date,
            'stock' => $request->stock,
            'supplier_id' => $request->supplier_id,
            'purchase_price' => $request->purchase_price ?? 0,
            'price' => $request->selling_price,
            'image' => $productImagePath,
            'receipt_image' => $receiptImagePath,
        ]);

        return redirect()->route('kelola.gudang')->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Update harga jual barang saja (Sesuai Route `products.updatePrice`)
     */
    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ], [
            'price.required' => 'Harga baru wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
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

        // Hapus foto produk dari storage jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus foto resi dari storage jika ada
        if ($product->receipt_image && Storage::disk('public')->exists($product->receipt_image)) {
            Storage::disk('public')->delete($product->receipt_image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }
}
