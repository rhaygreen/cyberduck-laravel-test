<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSale>
 */
class ProductSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id'    => 1,
            'sale_id'       => 1,
            'quantity'      => 1,
            'unit_cost'     => new Money(fake()->randomNumber(4), new Currency('GBP'), true),
            'selling_price' => new Money(fake()->randomNumber(4), new Currency('GBP'), true),
        ];
    }
}
