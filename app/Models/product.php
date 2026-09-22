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
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'receipt_image',
        'price',
        'stock',
        'supplier_id',
        'purchase_price',
        'expired_date',
        'status',
    ];

    /**
     * Accessor untuk mendapatkan URL gambar produk yang siap ditampilkan di blade (img).
     */
    public function getImgAttribute(): string
    {
        $img = $this->image ?? $this->receipt_image;

        if (! empty($img)) {
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                return $img;
            }

            return asset('storage/'.$img);
        }

        return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=300';
    }

    /**
     * Accessor image_url untuk kompatibilitas tampilan stok kritis.
     */
    public function getImageUrlAttribute(): string
    {
        return $this->img;
    }

    /**
     * Relasi ke Model Category (Setiap produk memiliki satu kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Relasi ke Model Supplier (Opsional)
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
