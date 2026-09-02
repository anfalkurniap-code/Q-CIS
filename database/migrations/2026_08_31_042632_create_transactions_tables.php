<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Transactions (Header)
        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->string('invoice_number')->unique();
                $table->decimal('total_price', 15, 2);
                $table->string('payment_method');
                $table->string('transaction_type')->default('PURCHASE');
                $table->timestamps();
            });
        }

        // Tabel Transaction Details (Rincian Item)
        if (!Schema::hasTable('transaction_details')) {
            Schema::create('transaction_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
                $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
                $table->string('product_name');
                $table->integer('quantity');
                $table->decimal('price', 15, 2);
                $table->decimal('subtotal', 15, 2);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
        Schema::dropIfExists('transactions');
    }
};