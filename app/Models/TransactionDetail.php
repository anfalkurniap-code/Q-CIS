<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'subtotal',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
<<<<<<< HEAD
}
=======

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
>>>>>>> 8e3129cae8956f17d92deca875c8be449ebbe1b5
