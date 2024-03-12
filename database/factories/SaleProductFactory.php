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
        $id_product = Product::pluck('id')->random();
        $product = Product::find($id_product);
        $quantity = $this->faker->randomDigitNotZero();
        $amount = $quantity * $product->price;
        $id_sale = Sale::pluck('id')->random();
        $random_sale = Sale::find($id_sale);

        return [
            'quantity' => $quantity,
            'amount' => $amount,
            'id_sale' => $id_sale,
            'id_product' => $id_product,
            'created_at' => $random_sale->created_at,
        ];
    }
}
