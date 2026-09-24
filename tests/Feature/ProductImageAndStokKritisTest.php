<?php

use App\Http\Controllers\ReportkepalatokoController;
use App\Models\BarangMasuk;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
    $user = User::factory()->create(['role' => 'kasir']);

    $response = $this->actingAs($user)->get('/shop');

    $response->assertSuccessful();
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

    // Verifikasi tersimpan di barang_masuks (pending)
    $barangMasuk = BarangMasuk::where('nama_barang', 'Teh Botol Sosro Kotak')->first();
    expect($barangMasuk)->not->toBeNull();

    // Approve oleh Kepala Toko agar masuk ke products
    (new ReportkepalatokoController)->approve($barangMasuk->id);

    // Verifikasi tersimpan di database products
    $product = Product::where('name', 'Teh Botol Sosro Kotak')->first();
    expect($product)->not->toBeNull();
    expect($product->status)->toBe('approved');
    expect($product->image)->not->toBeNull();
    expect($product->price)->toEqual(5000);
    expect($product->stock)->toEqual(25);

    // Verifikasi berkas tersimpan di storage
    Storage::disk('public')->assertExists($product->image);

    // Verifikasi accessor gambar terhubung
    expect($product->img)->toContain('storage/'.$product->image);
    expect($product->image_url)->toContain('storage/'.$product->image);

    // Verifikasi tampil di halaman kasir
    $user = User::factory()->create(['role' => 'kasir']);
    $kasirResponse = $this->actingAs($user)->get('/shop');
    $kasirResponse->assertSuccessful();
    $kasirResponse->assertSee('Teh Botol Sosro Kotak');
});

test('bisa menghapus barang di kelola gudang', function () {
    $category = Category::firstOrCreate(['name' => 'Makanan']);
    $product = Product::create([
        'name' => 'Kripik Singkong',
        'category_id' => $category->id,
        'price' => 10000,
        'purchase_price' => 7000,
        'stock' => 15,
        'status' => 'approved',
    ]);

    $response = $this->delete("/products/{$product->id}");

    $response->assertRedirect();
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

test('bisa mengupdate harga barang di kelola gudang', function () {
    $category = Category::firstOrCreate(['name' => 'Makanan']);
    $product = Product::create([
        'name' => 'Kripik Bawang',
        'category_id' => $category->id,
        'price' => 8000,
        'purchase_price' => 5000,
        'stock' => 20,
        'status' => 'approved',
    ]);

    $response = $this->put("/products/{$product->id}/update-price", [
        'purchase_price' => 6000,
        'price' => 9500,
    ]);

    $response->assertRedirect();
    $product->refresh();
    expect($product->price)->toEqual(9500);
    expect($product->purchase_price)->toEqual(6000);
});
