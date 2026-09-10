<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    // Sesuaikan nama tabel jika berbeda di database Anda
    protected $table = 'barang_masuks';

    // Izinkan mass assignment pada kolom
    protected $guarded = ['id'];
}
