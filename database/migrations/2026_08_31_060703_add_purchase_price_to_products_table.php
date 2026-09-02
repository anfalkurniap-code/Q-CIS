<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Pengecekan ini wajib ada agar tidak error Duplicate Column
            if (!Schema::hasColumn('products', 'purchase_price')) {
                $table->decimal('purchase_price', 15, 2)->default(0)->after('stock');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'purchase_price')) {
                $table->dropColumn('purchase_price');
            }
        });
    }
};