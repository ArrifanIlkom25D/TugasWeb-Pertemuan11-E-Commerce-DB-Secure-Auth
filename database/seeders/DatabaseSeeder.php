<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,   // kategori + brand + 54 produk
            OrderSeeder::class,     // order, order_items, reviews
        ]);
    }
}
