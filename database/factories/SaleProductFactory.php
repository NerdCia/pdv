<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleProduct>
 */
class SaleProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = DB::table('products')->inRandomOrder()->first();
        $quantity = $this->faker->randomNumber(1);
        $amount = $quantity * $product->price;

        return [
            'quantity' => $quantity,
            'amount' => $amount,
            'id_sale' => Sale::pluck('id')->random(),
            'id_product' => Product::pluck('id')->random(),
        ];
    }
}
