<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('dapat menampilkan dashboard kepala toko dengan filter default hari ini', function () {
    $response = $this->get(route('dashboard.kepalatoko'));

    $response->assertSuccessful();
    $response->assertViewHas('filter_type', 'today');
    $response->assertViewHas('chart_labels');
    $response->assertViewHas('chart_values');
});

it('dapat memfilter data dashboard berdasarkan semua waktu (total keseluruhan)', function () {
    $response = $this->get(route('dashboard.kepalatoko', ['filter_type' => 'all']));

    $response->assertSuccessful();
    $response->assertViewHas('filter_type', 'all');
    $response->assertSee('Semua Waktu');
});

it('dapat menampilkan halaman stok barang kepala toko', function () {
    $response = $this->get(route('stok.kepalatoko'));

    $response->assertSuccessful();
    $response->assertViewIs('stokbarang-kepalatoko');
    $response->assertViewHas('totalItems');
    $response->assertViewHas('lowStockCount');
});

it('dapat merespons payload json stok barang realtime untuk polling', function () {
    $response = $this->get(route('stok.kepalatoko', ['json' => 1]));

    $response->assertSuccessful();
    $response->assertJsonStructure([
        'total_items',
        'low_stock_count',
        'products',
    ]);
});
