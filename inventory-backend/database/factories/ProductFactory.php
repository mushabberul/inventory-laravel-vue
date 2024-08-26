<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\User as Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence;
        return [
            'category_id' => Category::select('id')->get()->random()->id,
            'brand_id' => Brand::select('id')->get()->random()->id,
            'supplier_id' => Supplier::supplier()->select('id')->get()->random()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'original_price' => rand(50,5000),
            'sell_price' => rand(50,5000),
            'stock' => rand(10,100),
            'description' => fake()->paragraph(6),
            'code' => Str::uuid(),
        ];


    }
}
