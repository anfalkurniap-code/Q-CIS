<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Menampilkan halaman form input barang
    public function create()
    {
        // Mengambil data supplier jika tabel/model tersedia
        $suppliers = class_exists(Supplier::class) 
            ? Supplier::all() 
            : (Schema::hasTable('suppliers') ? DB::table('suppliers')->get() : collect());
        
        // Hitung stok kritis (stok <= 10)
        $stokKritisCount = Product::where('stock', '<=', 10)->count();

        return view('inputbarang', compact('suppliers', 'stokKritisCount'));
    }

    // Menyimpan data barang baru atau memperbarui stok jika produk sudah ada
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name'   => 'required|string|max:255',
            'expired_date'   => 'required|date',
            'stock'          => 'required|integer|min:1',
            'supplier_id'    => 'nullable|exists:suppliers,id',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'receipt_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'product_name.required'  => 'Nama produk wajib diisi.',
            'expired_date.required'  => 'Tanggal kadaluwarsa wajib diisi.',
            'stock.required'         => 'Jumlah stok awal wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
            'supplier_id.exists'     => 'Supplier yang dipilih tidak valid.',
            'receipt_image.image'    => 'Bukti nota harus berupa berkas gambar.',
            'receipt_image.max'      => 'Ukuran foto nota maksimal 2MB.',
        ]);

        // Cari produk dengan nama dan tanggal kadaluarsa yang sama
        $existingProduct = Product::where('name', $validated['product_name'])
            ->whereDate('expired_date', $validated['expired_date'])
            ->first();

        if ($existingProduct) {
            // 1. Tambah stok yang sudah ada
            $existingProduct->increment('stock', $validated['stock']);

            // 2. Perbarui harga jual jika harga baru diinput berbeda
            if ($validated['selling_price'] > 0) {
                $existingProduct->update(['price' => $validated['selling_price']]);
            }

            $message = 'Stok produk ' . $validated['product_name'] . ' berhasil ditambahkan!';
        } else {
            // Buat produk baru jika tidak ditemukan data yang sama
            Product::create([
                'name'         => $validated['product_name'],
                'slug'         => Str::slug($validated['product_name']) . '-' . time(),
                'price'        => $validated['selling_price'],
                'stock'        => $validated['stock'],
                'expired_date' => $validated['expired_date'],
                'description'  => $request->input('description', null),
            ]);

            $message = 'Data barang baru berhasil ditambahkan!';
        }

        // Redirect kembali sesuai route kelola barang yang tersedia
        if (\Route::has('kelola.gudang')) {
            return redirect()->route('kelola.gudang')->with('success', $message);
        }

        return redirect()->route('products.index')->with('success', $message);
    }
}