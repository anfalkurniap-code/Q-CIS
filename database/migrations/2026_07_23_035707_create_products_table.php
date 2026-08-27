<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Kode & Identitas Produk
            $table->string('product_code')->nullable()->unique();
            $table->string('barcode')->nullable();
            $table->string('product_name')->nullable(); // Dari Incoming
            $table->string('nama')->nullable();         // Dari Stashed
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('kategori')->default('Umum');
            
            // Stok
            $table->integer('current_stock')->default(0); // Dari Incoming
            $table->integer('stok')->default(0);          // Dari Stashed
            $table->integer('minimum_stock_threshold')->default(5);
            
            // Harga
            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->integer('selling_price')->default(0); // Dari Incoming
            $table->integer('harga')->default(0);         // Dari Stashed
            
            // Relasi, Media & Tanggal
            $table->foreignId('supplier_id')->nullable();
            $table->string('receipt_image')->nullable();
            $table->string('img')->nullable();
            $table->date('expired_date')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};