<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('halaman stok kritis dapat diakses tanpa error view not found', function () {
    $response = $this->get('/stok-kritis');

    $response->assertStatus(200);
    $response->assertViewIs('stok-kritis');
});

test('halaman kasir shop dapat diakses dan menampilkan katalog', function () {
    $response = $this->get('/shop');

    $response->assertStatus(200);
    $response->assertViewIs('HalamanShop');
    $response->assertViewHas('products');
});

test('bisa menginput produk dengan gambar dan langsung tersimpan ke database serta kasir', function () {
    Storage::fake('public');

    $category = Category::firstOrCreate(['name' => 'Minuman']);

    $file = UploadedFile::fake()->create('teh_botol.jpg', 50, 'image/jpeg');

    $response = $this->post(route('products.store'), [
        'barcode' => '8991234567890',
        'product_name' => 'Teh Botol Sosro Kotak',
        'category_id' => $category->id,
        'expired_date' => '2027-12-31',
        'stock' => 25,
        'purchase_price' => 3000,
        'selling_price' => 5000,
        'image' => $file,
    ]);

    $response->assertRedirect(route('kelola.gudang'));

    // Verifikasi tersimpan di database
    $product = Product::where('name', 'Teh Botol Sosro Kotak')->first();
    expect($product)->not->toBeNull();
    expect($product->status)->toBe('approved');
    expect($product->image)->not->toBeNull();
    expect($product->price)->toEqual(5000);
    expect($product->stock)->toEqual(25);

    // Verifikasi berkas tersimpan di storage
    Storage::disk('public')->assertExists($product->image);

    // Verifikasi accessor gambar terhubung
    expect($product->img)->toContain('storage/' . $product->image);
    expect($product->image_url)->toContain('storage/' . $product->image);

    // Verifikasi tampil di halaman kasir
    $kasirResponse = $this->get('/shop');
    $kasirResponse->assertStatus(200);
    $kasirResponse->assertSee('Teh Botol Sosro Kotak');
});

