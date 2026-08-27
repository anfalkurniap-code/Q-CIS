<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Daftarkan semua kolom yang ada di database agar diizinkan untuk diisi
    protected $fillable = [
        'product_code',
        'barcode',
        'product_name',
        'name',
        'nama',
        'slug',
        'description',
        'kategori',
        'current_stock',
        'stock',
        'stok',
        'minimum_stock_threshold',
        'purchase_price',
        'selling_price',
        'price',
        'harga',
        'supplier_id',
        'receipt_image',
        'img',
        'expired_date',
    ];
}