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
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'expired_date',
    ];
}