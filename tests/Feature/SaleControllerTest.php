<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_canAccessSalesPageWhenLoggedIn()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/sales');
        $response->assertStatus(200);
    }

    public function test_canNotAccessSalesPageWhenNotLoggedIn()
    {
        $response = $this->get('/sales');
        $response->assertStatus(302);
    }

    public function test_canFetchListOfSales()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $sale = Sale::factory()->create([
            'user_id' => $user->id
        ]);
        $productSale = ProductSale::factory()->create([
            'product_id'    => $product->id,
            'sale_id'       => $sale->id,
            'quantity'      => 1,
            'unit_cost'     => new Money(1000, new Currency('GBP')),
            'selling_price' => new Money(2000, new Currency('GBP')),
        ]);


        $response= $this->actingAs($user)
                         ->get('/sale');
        $response->assertJsonFragment([$product->name]);
        $response->assertJsonFragment([$productSale->unit_cost->getAmount()]);

    }

    public function test_canSaveSalesRecord()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();
        $response= $this->actingAs($user)
        ->post('/sale/store',[
            'id_product'    => $product->id,
            'quantity'      => 1,
            'unit_cost'     => 10
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas(
            'product_sale',
            [
                'product_id' => $product->id,
                'quantity'  => 1
            ]);
    }
}
