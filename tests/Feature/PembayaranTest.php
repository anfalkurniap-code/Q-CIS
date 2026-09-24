<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('dapat menampilkan halaman pembayaran', function () {
    $user = User::factory()->create(['role' => 'kasir']);

    $response = $this->actingAs($user)->get(route('pembayaran.index'));

    $response->assertSuccessful();
});

it('route pembayaran.proses dapat diakses untuk memproses transaksi', function () {
    $user = User::factory()->create(['role' => 'kasir']);

    $response = $this->actingAs($user)->post(route('pembayaran.proses'), [
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
