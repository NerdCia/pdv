<?php

namespace Database\Factories;

use App\Models\Category;
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
        $price = $this->faker->randomFloat(2, 1, 999);
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'quantity' => $this->faker->randomNumber(2),
            'price' => $price,
            'expense' => $this->faker->randomFloat(2, $price / 2, $price),
            'image' => $this->faker->imageUrl(500, 500),
            'id_category' => Category::pluck('id')->random(),
        ];
    }
}
