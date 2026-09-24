<?php

use App\Models\BarangMasuk;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('dapat menolak barang masuk dan menampilkan notifikasi serta status ditolak di riwayat gudang', function () {
    $user = User::factory()->create(['role' => 'kepalatoko']);
    $category = Category::create(['name' => 'Snack']);

    // 1. Gudang mengajukan barang masuk
    $barang = BarangMasuk::create([
        'nama_barang' => 'Chiki Ball Cokelat Test',
        'category_id' => $category->id,
        'jumlah' => 20,
        'harga' => 5000,
        'purchase_price' => 3500,
        'expired_date' => '2027-12-31',
        'status' => 'pending',
    ]);

    // 2. Kepala toko menolak barang tersebut
    $response = $this->actingAs($user)->patch(route('report.reject', $barang->id));
    $response->assertRedirect();
    $response->assertSessionHas('error');

    // 3. Verifikasi status barang di database menjadi rejected
    $this->assertDatabaseHas('barang_masuks', [
        'id' => $barang->id,
        'status' => 'rejected',
    ]);

    // 4. Verifikasi notifikasi muncul di kelola-gudang
    $responseKelola = $this->actingAs($user)->get(route('kelola.gudang'));
    $responseKelola->assertStatus(200);
    $responseKelola->assertSee('Pengajuan Barang Ditolak');
    $responseKelola->assertSee('Chiki Ball Cokelat Test');

    // 5. Verifikasi barang muncul di riwayat gudang dengan badge DITOLAK
    $responseRiwayat = $this->actingAs($user)->get(route('Riwayatgudang'));
    $responseRiwayat->assertStatus(200);
    $responseRiwayat->assertSee('Chiki Ball Cokelat Test');
    $responseRiwayat->assertSee('DITOLAK');

    // 6. Verifikasi setelah halaman kelola-gudang di-refresh (get ulang), notifikasi otomatis hilang
    $responseRefresh = $this->actingAs($user)->get(route('kelola.gudang'));
    $responseRefresh->assertStatus(200);
    $responseRefresh->assertDontSee('Pengajuan Barang Ditolak');
});
