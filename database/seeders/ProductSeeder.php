<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('slug', 'electronics')->first();
        $fashion = Category::where('slug', 'fashion')->first();
        $home = Category::where('slug', 'home-living')->first();

        $products = [
            // Electronics
            [
                'nama' => 'Smartphone Pro Max', // Using 'nama' as per defined in Product model/migration
                'harga' => 12000000,
                'stok' => 50,
                'deskripsi' => 'High-end smartphone with professional camera and long battery life.',
                'image' => null, // Placeholder
                'category_id' => $electronics?->id,
            ],
            [
                'nama' => 'Wireless Noise Cancelling Headphones',
                'harga' => 3500000,
                'stok' => 100,
                'deskripsi' => 'Immersive sound experience with active noise cancellation.',
                'image' => null,
                'category_id' => $electronics?->id,
            ],
            // Fashion
            [
                'nama' => 'Classic Denim Jacket',
                'harga' => 750000,
                'stok' => 25,
                'deskripsi' => 'Timeless denim jacket that goes with everything.',
                'image' => null,
                'category_id' => $fashion?->id,
            ],
            [
                'nama' => 'Running Sneakers',
                'harga' => 1200000,
                'stok' => 40,
                'deskripsi' => 'Lightweight and comfortable sneakers for your daily run.',
                'image' => null,
                'category_id' => $fashion?->id,
            ],
            // Home
            [
                'nama' => 'Minimalist Table Lamp',
                'harga' => 450000,
                'stok' => 30,
                'deskripsi' => 'Elegant table lamp to brighten up your workspace.',
                'image' => null,
                'category_id' => $home?->id,
            ],
            [
                'nama' => 'Ceramic Plant Pot',
                'harga' => 150000,
                'stok' => 60,
                'deskripsi' => 'Handcrafted ceramic pot for your indoor plants.',
                'image' => null,
                'category_id' => $home?->id,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
