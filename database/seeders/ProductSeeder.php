<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Kopi Robusta Premium',
            'slug' => Str::slug('Kopi Robusta Premium'),
            'description' => 'Kopi Robusta kualitas terbaik yang dipanggang dengan tingkat medium, menghasilkan aroma yang kuat dan rasa yang pekat.',
            'price' => 45000.00,
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Teh Hijau Organik',
            'slug' => Str::slug('Teh Hijau Organik'),
            'description' => 'Daun teh hijau murni dari pegunungan tinggi, kaya akan antioksidan alami dan memiliki rasa yang menyegarkan.',
            'price' => 35000.00,
            'stock' => 30,
        ]);

        Product::create([
            'name' => 'Cokelat Hitam Nusantara',
            'slug' => Str::slug('Cokelat Hitam Nusantara'),
            'description' => 'Cokelat hitam murni 70% asli Indonesia dengan sentuhan manis yang seimbang dan cita rasa buah yang khas.',
            'price' => 60000.00,
            'stock' => 12,
        ]);
    }
}
