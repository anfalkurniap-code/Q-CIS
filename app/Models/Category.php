<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Kolom yang diizinkan untuk diisi secara mass assignment
    protected $fillable = [
        'name',
        'nama',
        'slug',
        'description',
    ];

    /**
     * Relasi One-to-Many ke Model Product
     * Satu kategori bisa memiliki banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}