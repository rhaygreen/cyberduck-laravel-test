<?php

namespace Tests\Unit;

use App\Services\ProductService;
use PHPUnit\Framework\TestCase;
use App\Models\Product;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use App\DTOs\ProductQuantityPriceDTO;

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

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

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

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getAmount(), '64.67');
    }

    public function testSellingPriceCalculation_validProductAndIntegerQuantityOfFive_ReturnValidPrice()
    {
        $product = Product::factory()->make([
            'name'          => 'Gold Coffee',
            'margin'        => 25,
            'shipping_cost' => new Money('10.00', new Currency('GBP')),
        ]);
        $unitPrice = new Money('12.00', new Currency('GBP'));
        $quantity = 5;
        $service = new ProductService();

        $dto = new ProductQuantityPriceDTO($product, $quantity, $unitPrice);

        $result = $service->calculateSellingPrice($dto);

        $this->assertInstanceOf(Money::class, $result);
        $this->assertEquals($result->getAmount(), '90.00');
    }
}
