<?php

namespace Database\Seeders;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'id' => 1,
            'name' => 'Gold Coffee',
            'margin' => 25, //percentage
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
    }
}
