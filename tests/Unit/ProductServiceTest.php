<?php

namespace Tests\Unit;

use App\Services\ProductService;
use PHPUnit\Framework\TestCase;
use App\Models\Product;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use App\DTOs\SellingPriceCalculationDTO;

class ProductServiceTest extends TestCase
{
    public function testSellingPriceCalculation_validProductAndIntegerQuantityOfOne_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name'          => 'Gold Coffee',
            'margin'        => 25,
            'shipping_cost' => new Money('10.00', new Currency('GBP')),
        ]);
        $unitPrice = new Money('10.00', new Currency('GBP'));
        $quantity = 1;
        $service = new ProductService();

        $dto = new SellingPriceCalculationDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getAmount(), '23.34');
    }

    public function testSellingPriceCalculation_validProductAndIntegerQuantityOfTwo_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name'          => 'Gold Coffee',
            'margin'        => 25,
            'shipping_cost' => new Money('10.00', new Currency('GBP')),
        ]);
        $unitPrice = new Money('20.50', new Currency('GBP'));
        $quantity = 2;
        $service = new ProductService();

        $dto = new SellingPriceCalculationDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getAmount(), '64.67');
    }
}
