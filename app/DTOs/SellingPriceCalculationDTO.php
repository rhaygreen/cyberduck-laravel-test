<?php

namespace App\DTOs;

use App\Models\Product;
use Akaunting\Money\Money;

class SellingPriceCalculationDTO
{
    public function __construct(
        private Product $product,
        private int $quantity,
        private Money $unitPrice,
        ) {}

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }
}
