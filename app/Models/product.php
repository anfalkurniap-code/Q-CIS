<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Atribut yang dapat diisi secara massal (Mass Assignable)
    protected $fillable = [
        'barcode',
        'name',
        'slug',
        'description',
        'category_id',    // WAJIB ADA agar ID kategori tersimpan ke DB
        'purchase_price', // WAJIB ADA agar harga beli tersimpan ke DB
        'price',
        'stock',
        'expired_date', 
    ];

    /**
     * Relasi ke Model Category (Setiap produk memiliki satu kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}