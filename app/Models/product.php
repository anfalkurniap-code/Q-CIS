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
    'category_id',
    'name',
    'slug',
    'description',
    'price',
    'stock',
    'purchase_price',
    'expired_date',
    'status', 

    ];

    /**
     * Relasi ke Model Category (Setiap produk memiliki satu kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}