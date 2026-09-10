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
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'barcode')) {
                $table->string('barcode')->nullable()->after('id');
            }
            if (! Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
            if (! Schema::hasColumn('products', 'receipt_image')) {
                $table->string('receipt_image')->nullable()->after('image');
            }
            if (! Schema::hasColumn('products', 'supplier_id')) {
                $table->unsignedBigInteger('supplier_id')->nullable()->after('stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('products', 'barcode')) {
                $columnsToDrop[] = 'barcode';
            }
            if (Schema::hasColumn('products', 'image')) {
                $columnsToDrop[] = 'image';
            }
            if (Schema::hasColumn('products', 'receipt_image')) {
                $columnsToDrop[] = 'receipt_image';
            }
            if (Schema::hasColumn('products', 'supplier_id')) {
                $columnsToDrop[] = 'supplier_id';
            }
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
