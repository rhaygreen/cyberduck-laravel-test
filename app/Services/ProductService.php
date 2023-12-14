<?php

namespace App\Services;

use App\Models\Product;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use App\DTOs\SellingPriceCalculationDTO;

class ProductService
{
    /**
     * Establish the selling price for a given product and quantity
     */
    public function calculateSellingPrice(SellingPriceCalculationDTO $dto) :Money
    {
        $product = $dto->getProduct();
        $formattedMargin = $product->margin / 100;

        $cost = $dto->getQuantity() * $dto->getUnitPrice()->getAmount();

        $sellingPrice = ($cost / (1 - $formattedMargin)) + $product->shipping_cost->getAmount();

        return new Money($sellingPrice, new Currency('GBP'), true);
    }
}
