<?php

namespace Database\Factories;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
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
            'name' => fake()->name(),
            'margin' => fake()->randomNumber(2),
            'shipping_cost' => new Money(fake()->randomNumber(4), new Currency('GBP'), true),
        ];
    }
}
