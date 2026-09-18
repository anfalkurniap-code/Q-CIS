<?php

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('halaman report kepala toko menampilkan data barang keluar dari kasir', function () {
    $transaction = Transaction::create([
        'invoice_number' => 'TRX-20260916-0001',
        'total_price' => 50000,
        'payment_method' => 'CASH',
        'transaction_type' => 'PURCHASE',
    ]);

    TransactionDetail::create([
        'transaction_id' => $transaction->id,
        'product_name' => 'Chitato Lite',
        'quantity' => 2,
        'price' => 25000,
        'subtotal' => 50000,
    ]);

    $response = $this->get(route('report.kepalatoko', ['tab' => 'keluar']));

    $response->assertStatus(200);
    $response->assertSee('Laporan Barang Keluar');
    $response->assertSee('TRX-20260916-0001');
    $response->assertSee('Chitato Lite');
    $response->assertSee('50.000');
});

test('halaman report kepala toko mendukung pencarian barang keluar', function () {
    $trx1 = Transaction::create([
        'invoice_number' => 'TRX-1111',
        'total_price' => 20000,
        'payment_method' => 'CASH',
        'transaction_type' => 'PURCHASE',
    ]);
    TransactionDetail::create([
        'transaction_id' => $trx1->id,
        'product_name' => 'Susu Ultra Milk',
        'quantity' => 2,
        'price' => 10000,
        'subtotal' => 20000,
    ]);

    $trx2 = Transaction::create([
        'invoice_number' => 'TRX-2222',
        'total_price' => 15000,
        'payment_method' => 'QRIS',
        'transaction_type' => 'PURCHASE',
    ]);
    TransactionDetail::create([
        'transaction_id' => $trx2->id,
        'product_name' => 'Roti Tawar',
        'quantity' => 1,
        'price' => 15000,
        'subtotal' => 15000,
    ]);

    $response = $this->get(route('report.kepalatoko', ['tab' => 'keluar', 'search' => 'Susu']));

    $response->assertStatus(200);
    $response->assertSee('TRX-1111');
    $response->assertSee('Susu Ultra Milk');
    $response->assertDontSee('TRX-2222');
});
