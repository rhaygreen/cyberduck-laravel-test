<?php

namespace App\DTOs;

use Akaunting\Money\Money;
use App\Models\Product;

class ProductQuantityPriceDTO
{
    public function __construct(
        private Product $product,
        private float $quantity,
        private Money $unitPrice,
    ) {
    }

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
