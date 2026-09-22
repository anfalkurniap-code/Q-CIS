<?php

it('dapat menampilkan halaman pembayaran', function () {
    $response = $this->get(route('pembayaran.index'));

    $response->assertSuccessful();
});

it('route pembayaran.proses dapat diakses untuk memproses transaksi', function () {
    $response = $this->post(route('pembayaran.proses'), [
        'cart_data' => json_encode([]),
        'payment_method' => 'cash',
        'subtotal' => 10000,
        'discount' => 0,
        'total_price' => 10000,
        'cash_amount' => 10000,
    ]);

    // Kosong cart data mengembalikan redirect back dengan error
    $response->assertRedirect();
});
