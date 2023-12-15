<?php

namespace Tests\Unit;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\ProductQuantityPriceDTO;
use App\Models\Product;
use App\Services\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    public function testSellingPriceCalculation_validProductAndIntegerQuantityOfOne_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name' => 'Gold Coffee',
            'margin' => 25,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
        $unitPrice = new Money(1000, new Currency('GBP'));
        $quantity = 1;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getValue(), 23.34);
    }

    public function testSellingPriceCalculation_validProductAndIntegerQuantityOfTwo_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name' => 'Gold Coffee',
            'margin' => 25,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
        $unitPrice = new Money(2050, new Currency('GBP'));
        $quantity = 2;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getValue(), 64.67);
    }

    public function testSellingPriceCalculation_validProductAndIntegerQuantityOfFive_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name' => 'Gold Coffee',
            'margin' => 25,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
        $unitPrice = new Money(1200, new Currency('GBP'));
        $quantity = 5;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getValue(), 90.00);
    }
}
