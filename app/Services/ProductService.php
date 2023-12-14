<?php

namespace App\Services;

use App\Models\Product;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use App\DTOs\ProductQuantityPriceDTO;

class ProductService
{
    /**
     * Establish the selling price for a given product and quantity
     */
    public function calculateSellingPrice(ProductQuantityPriceDTO $dto) :Money
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
        if(empty($numbers[1]) || count_chars($numbers[1]) < 3) {
            return $needsFormatting;
        }

        //if the number has a decimal precision of 3 or more, then we need to truncate it and increase the last digit by one.
        $toKeep = substr($numbers[1],0,2);
        return (float) $numbers[0] . '.' . (++$toKeep);

    }
}
