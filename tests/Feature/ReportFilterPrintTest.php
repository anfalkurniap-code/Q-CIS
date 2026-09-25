<?php

use App\Models\BarangMasuk;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('halaman report mendukung filter rentang tanggal dan menampilkan ringkasan kalkulasi', function () {
    // Barang Masuk 1 (Dalam rentang)
    BarangMasuk::create([
        'nama_barang' => 'Indomie Goreng',
        'jumlah' => 50,
        'harga' => 3000,
        'purchase_price' => 2500,
        'status' => 'approved',
        'created_at' => '2026-09-10 10:00:00',
    ]);

    // Barang Masuk 2 (Luar rentang)
    BarangMasuk::create([
        'nama_barang' => 'Kopi Kapal Api',
        'jumlah' => 20,
        'harga' => 2000,
        'purchase_price' => 1500,
        'status' => 'approved',
        'created_at' => '2026-08-01 10:00:00',
    ]);

    // Barang Keluar 1 (Dalam rentang)
    $trx1 = Transaction::create([
        'invoice_number' => 'TRX-20260910-001',
        'total_price' => 60000,
        'payment_method' => 'CASH',
        'transaction_type' => 'PURCHASE',
    ]);
    $trx1->created_at = '2026-09-10 14:00:00';
    $trx1->save();

    TransactionDetail::create([
        'transaction_id' => $trx1->id,
        'product_name' => 'Indomie Goreng',
        'quantity' => 20,
        'price' => 3000,
        'subtotal' => 60000,
    ]);

    // Barang Keluar 2 (Luar rentang)
    $trx2 = Transaction::create([
        'invoice_number' => 'TRX-20260801-001',
        'total_price' => 10000,
        'payment_method' => 'QRIS',
        'transaction_type' => 'PURCHASE',
    ]);
    $trx2->created_at = '2026-08-01 14:00:00';
    $trx2->save();
    TransactionDetail::create([
        'transaction_id' => $trx2->id,
        'product_name' => 'Kopi Kapal Api',
        'quantity' => 5,
        'price' => 2000,
        'subtotal' => 10000,
    ]);

    // Access Report with Start & End Date
    $response = $this->get(route('report.kepalatoko', [
        'start_date' => '2026-09-01',
        'end_date' => '2026-09-15',
        'tab' => 'masuk',
    ]));

    $response->assertStatus(200);
    $response->assertSee('Indomie Goreng');
    $response->assertDontSee('Kopi Kapal Api');
    $response->assertSee('50 Pcs');
    $response->assertSee('Download PDF');
    $response->assertSee('Print Browser');
});

test('route pdf report menghasilkan file pdf dengan data yang terfilter', function () {
    BarangMasuk::create([
        'nama_barang' => 'Teh Botol Sosro',
        'jumlah' => 30,
        'harga' => 4000,
        'purchase_price' => 3000,
        'status' => 'approved',
        'created_at' => '2026-09-12 09:00:00',
    ]);

    $response = $this->get(route('report.pdf', [
        'start_date' => '2026-09-01',
        'end_date' => '2026-09-20',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/pdf');
});
