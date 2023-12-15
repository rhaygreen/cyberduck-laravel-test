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
    public function testSellingPriceCalculation_validProductMargin25Quantity1_ReturnValidPrice()
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

    public function testSellingPriceCalculation_validProductMargin25Quantity2_ReturnValidPrice()
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

    public function testSellingPriceCalculation_validProductMargin25Quantity5_ReturnValidPrice()
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

    public function testSellingPriceCalculation_validProductMargin15Quantity5_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name' => 'Arabic Coffee',
            'margin' => 15,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
        $unitPrice = new Money(1200, new Currency('GBP'));
        $quantity = 5;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getValue(), 80.59);
    }

    public function testSellingPriceCalculation_validProductMargin15Quantity10Decimal5_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name' => 'Arabic Coffee',
            'margin' => 15,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
        $unitPrice = new Money(1000, new Currency('GBP'));
        $quantity = 10.5;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getValue(), 133.53);
    }

    public function testSellingPriceCalculation_validProductMargin15Quantity10UnitCost1078_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name' => 'Arabic Coffee',
            'margin' => 15,
            'shipping_cost' => new Money(1000, new Currency('GBP')),
        ]);
        $unitPrice = new Money(1078, new Currency('GBP'));
        $quantity = 10;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getValue(), 136.83);
    }
}
