<?php

namespace Tests\Feature;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_canSubmitRequestForSellingPrice()
    {
        Product::factory()->create([
            'id' => 1,
            'name' => 'Gold Coffee',
            'margin' => 25,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);

        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/product/1/calculateSellingPrice?quantity=2&unit_cost=20.5');
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), '£64.67');

    }
}
