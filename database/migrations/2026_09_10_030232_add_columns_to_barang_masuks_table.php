<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->string('barcode')->nullable()->after('nama_barang');
            $table->unsignedBigInteger('category_id')->nullable()->after('barcode');
            $table->unsignedBigInteger('supplier_id')->nullable()->after('category_id');
            $table->decimal('purchase_price', 15, 2)->nullable()->default(0)->after('harga');
            $table->date('expired_date')->nullable()->after('purchase_price');
            $table->string('image')->nullable()->after('expired_date');
            $table->string('receipt_image')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropColumn(['barcode', 'category_id', 'supplier_id', 'purchase_price', 'expired_date', 'image', 'receipt_image']);
        });
    }
};
