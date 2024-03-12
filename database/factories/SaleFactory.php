<?php

namespace Database\Factories;

use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_method' => $this->faker->creditCardType(),
            'id_user' => User::pluck('id')->random(),
            'created_at' => $this->faker->dateTimeBetween('-6 month'),
        ];
    }
}
