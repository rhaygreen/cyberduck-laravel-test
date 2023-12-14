<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_canSubmitRequestForSellingPrice()
    {
        Product::factory()->create([
            'id'            => 1,
            'name'          => 'Gold Coffee',
            'margin'        => 25,
            'shipping_cost' => new Money(1000, new Currency('GBP'))
        ]);

        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->get('/product/1/calculateSellingPrice?quantity=2&unit_cost=20.5');
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), '£64.67');

    }
}
