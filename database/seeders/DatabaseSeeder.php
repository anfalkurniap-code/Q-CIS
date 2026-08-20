<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Petugas Gudang
        User::updateOrCreate(
            ['email' => 'gudang@gmail.com'],
            [
                'name'     => 'Dimas Aditia Ananda',
                'username' => 'gudang',
                'password' => Hash::make('12345678'),
                'role'     => 'gudang',
            ]
        );

        // 2. Akun Petugas Kasir
        User::updateOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name'     => 'Petugas Kasir',
                'username' => 'kasir',
                'password' => Hash::make('12345678'),
                'role'     => 'kasir',
            ]
        );

        // 3. Akun Kepala Toko
        User::updateOrCreate(
            ['email' => 'kepala@smkmart.com'],
            [
                'name'     => 'Kepala Toko',
                'username' => 'kepalatoko',
                'password' => Hash::make('password123'),
                'role'     => 'kepala_toko',
            ]
        );

        // 4. Memanggil Seeder Produk (Hanya panggil jika file ProductSeeder.php memang ada)
        if (class_exists(ProductSeeder::class)) {
            $this->call([
                ProductSeeder::class,
            ]);
        }
    }
}