<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'purchase_price', // WAJIB ADA agar harga beli tersimpan ke DB
        'price',
        'stock',
        'expired_date',
    ];
}