<?php
namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $adminId  = User::where('email', 'admin@example.com')->value('id');
        $editorId = User::where('email', 'editor@example.com')->value('id');

        $brands = collect(['Samsung', 'Apple', 'Xiaomi', 'Asus', 'Logitech', 'Sony', 'Uniqlo', 'Nike', 'Adidas', 'Indomie', 'Philips', 'Miniso'])
            ->map(fn ($n) => Brand::firstOrCreate(['name' => $n]));

        // kategori => [[nama produk, harga]]
        $catalog = [
            'Smartphone' => [
                ['Samsung Galaxy A55 5G 8/256GB', 5999000], ['Xiaomi Redmi Note 13 Pro 8/256GB', 3899000],
                ['iPhone 15 128GB', 12999000], ['Samsung Galaxy S24 FE 8/256GB', 9499000],
                ['Xiaomi Poco X6 Pro 12/512GB', 4999000], ['Samsung Galaxy A15 6/128GB', 2399000],
                ['iPhone 13 128GB', 8999000], ['Xiaomi Redmi 13C 4/128GB', 1599000], ['Samsung Galaxy M35 5G 8/128GB', 3599000],
            ],
            'Laptop' => [
                ['Asus Vivobook Go 14 Ryzen 5', 7499000], ['Asus TUF Gaming F15 RTX 3050', 11999000],
                ['Asus Zenbook 14 OLED', 14999000], ['MacBook Air M2 13" 256GB', 15999000],
                ['Asus ROG Strix G16 RTX 4060', 24999000], ['Asus Vivobook 15 Intel Core i5', 8299000],
                ['MacBook Air M1 8/256GB', 11999000], ['Asus ExpertBook B1 Core i3', 6499000], ['Asus ProArt P16', 29999000],
            ],
            'Aksesoris Komputer' => [
                ['Logitech MX Master 3S Wireless Mouse', 1499000], ['Logitech G102 Lightsync Gaming Mouse', 299000],
                ['Logitech K380 Bluetooth Keyboard', 479000], ['Logitech MX Keys S Keyboard', 1799000],
                ['Logitech C920 HD Pro Webcam', 1099000], ['Logitech G435 Wireless Headset', 899000],
                ['Logitech M331 Silent Mouse', 249000], ['Logitech Pebble Keys 2 K380s', 549000], ['Logitech Brio 100 Webcam', 599000],
            ],
            'Audio' => [
                ['Sony WH-1000XM5 Noise Cancelling', 5499000], ['Sony WF-C700N True Wireless', 1799000],
                ['Sony ULT Wear Headphones', 3299000], ['Sony SRS-XB100 Portable Speaker', 899000],
                ['Xiaomi Redmi Buds 5 Pro', 599000], ['Apple AirPods 4', 2799000],
                ['Sony WH-CH520 Wireless', 799000], ['Apple AirPods Pro 2 USB-C', 3999000], ['Xiaomi Mi Portable Bluetooth Speaker', 449000],
            ],
            'Fashion Pria' => [
                ['Uniqlo Kaos Oversized Cotton Putih', 199000], ['Uniqlo Kemeja Flanel Lengan Panjang', 399000],
                ['Uniqlo Ultra Light Down Jacket', 799000], ['Nike Dri-FIT Running T-Shirt', 449000],
                ['Adidas Essentials 3-Stripes Hoodie', 849000], ['Uniqlo Celana Chino Slim Fit', 499000],
                ['Nike Air Force 1 07 Putih', 1649000], ['Adidas Samba OG', 1799000], ['Nike Revolution 7 Running Shoes', 999000],
            ],
            'Rumah & Dapur' => [
                ['Philips Air Fryer HD9200 4.1L', 1299000], ['Philips Rice Cooker HD3110 1.8L', 749000],
                ['Philips Blender HR2221 2L', 599000], ['Philips Steam Iron GC1749', 349000],
                ['Miniso Tumbler Stainless 500ml', 129000], ['Miniso Humidifier Aroma Diffuser', 189000],
                ['Philips LED Bulb 12W Cool Daylight (3 pcs)', 99000], ['Indomie Mi Goreng Original (isi 40)', 125000], ['Philips Kettle HD9350 1.7L', 399000],
            ],
        ];

        $i = 0;
        foreach ($catalog as $catName => $items) {
            $cat = Category::firstOrCreate(['name' => $catName], ['slug' => Str::slug($catName)]);
            foreach ($items as [$name, $price]) {
                $brand = $brands->first(fn ($b) => str_starts_with($name, $b->name)) ?? $brands->random();
                Product::create([
                    'user_id'     => $i++ % 2 ? $adminId : $editorId,
                    'category_id' => $cat->id,
                    'brand_id'    => $brand->id,
                    'name'        => $name,
                    'slug'        => Str::slug($name),
                    'description' => "{$name} - produk original bergaransi resmi. Stok terbatas, pengiriman ke seluruh Indonesia.",
                    'price'       => $price,
                    'stock'       => rand(0, 80),
                    'is_active'   => true,
                ]);
            }
        }
        // total = 6 kategori x 9 = 54 produk
    }
}
