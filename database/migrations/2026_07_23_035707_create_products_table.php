<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
   Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('barcode')->nullable();
    $table->string('product_name');
    $table->integer('current_stock');
    $table->foreignId('supplier_id')->nullable();
    $table->integer('purchase_price')->default(0);
    $table->integer('selling_price');
    $table->string('receipt_image')->nullable();
    $table->date('expired_date')->nullable(); 
    $table->timestamps();
});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};