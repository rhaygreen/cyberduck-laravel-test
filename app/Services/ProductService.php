<?php

namespace App\Services;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\ProductQuantityPriceDTO;
use App\Models\Product;

class ProductService
{
    /**
     * Establish the selling price for a given product and quantity
     */
    public function calculateSellingPrice(ProductQuantityPriceDTO $dto): Money
    {
        $product = $dto->getProduct();
        $formattedMargin = $product->margin / 100;

        $cost = $dto->getQuantity() * $dto->getUnitPrice()->getAmount();
        $sellingPrice = ($cost / (1 - $formattedMargin)) + $product->shipping_cost->getAmount();

        return new Money($this->formatDecimalInCurrency($sellingPrice), new Currency('GBP'));
    }

    /**
     * Handles a currency amount where there is more than 2 decimal places, since the
     * amount must be rounded up in this case.
     */
    private function formatDecimalInCurrency(float $needsFormatting): float
    {
        $numbers = explode('.', $needsFormatting);

        if (empty($numbers[1])) {
            //there are no decimals
            return $needsFormatting;
        }

        //if there is a decimal then up the pennies count by 1.
        return ++$numbers[0];

    }
}
