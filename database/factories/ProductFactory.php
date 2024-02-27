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
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomNumber(3),
            'image' => $this->faker->imageUrl(500, 500),
            'id_category' => Category::pluck('id')->random(),
        ];
    }
}
