<?php
namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'brand_id'    => Brand::inRandomOrder()->value('id'),
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name) . '-' . Str::random(4),
            'description' => fake()->paragraph(),
            'price'       => fake()->numberBetween(20, 5000) * 1000,
            'stock'       => fake()->numberBetween(0, 100),
            'is_active'   => true,
        ];
    }
}
