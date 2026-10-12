<?php
namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'user')->get();
        $products  = Product::all();

        foreach ($customers as $user) {
            foreach (range(1, rand(1, 3)) as $_) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'INV-' . strtoupper(uniqid()),
                    'status' => collect(['pending', 'paid', 'shipped', 'done'])->random(),
                ]);
                $total = 0;
                foreach ($products->random(rand(1, 4)) as $p) {
                    $qty = rand(1, 3);
                    $order->items()->create(['product_id' => $p->id, 'qty' => $qty, 'price' => $p->price]);
                    $total += $qty * $p->price;
                }
                $order->update(['total' => $total]);
            }

            foreach ($products->random(3) as $p) {
                Review::create([
                    'user_id' => $user->id, 'product_id' => $p->id,
                    'rating' => rand(3, 5),
                    'comment' => collect(['Barang bagus, sesuai deskripsi', 'Pengiriman cepat', 'Recommended seller!', 'Worth it dengan harganya'])->random(),
                ]);
            }
        }
    }
}
