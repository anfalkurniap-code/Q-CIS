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
                'name' => 'Dimas Aditia Ananda', // Sesuaikan dengan nama pengguna
                'password' => Hash::make('12345678'),
                'role' => 'gudang',
            ]
        );

        // 2. Akun Petugas Kasir (Opsional, agar kasir juga otomatis terbuat)
        User::updateOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name' => 'Petugas Kasir',
                'password' => Hash::make('12345678'),
                'role' => 'kasir',
            ]
        );

        // 3. Memanggil Seeder Produk
        $this->call([
            ProductSeeder::class,
        ]);
    }
}