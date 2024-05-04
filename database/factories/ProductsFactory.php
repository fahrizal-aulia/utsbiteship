<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => 'SKU' . str_pad($this->faker->unique()->numberBetween(1, 100), 3, '0', STR_PAD_LEFT),
            'product_category' => mt_rand(1, 10),
            'product_name' => $this->faker->sentence(2),
            'product_detail' => $this->faker->paragraph(),
            'product_brand' => mt_rand(1, 10),
            'product_price' => mt_rand(50, 500),
            'fileimages' => 'image' . mt_rand(1, 10) . '.jpg',
            'product_length' => mt_rand(5, 50),
            'product_width' => mt_rand(5, 50),
            'product_height' => mt_rand(10, 100),
            'product_weight' => mt_rand(100, 1000),
            'status' => 'Active',
            'deleted' => 'no',
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => null,
        ];
    }
}
