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
        $table->string('product_code')->unique();
        $table->string('product_name');
        $table->integer('current_stock')->default(0);
        $table->unsignedBigInteger('supplier_id')->nullable();
        $table->decimal('purchase_price', 15, 2)->default(0);
        $table->decimal('selling_price', 15, 2)->default(0);
        $table->string('image')->nullable();
        $table->integer('minimum_stock_threshold')->default(5);
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