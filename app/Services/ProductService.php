<?php

namespace App\Services;


class ProductService
{
    /**
     * Establish the selling price for a given product and quantity
     * @param int $productId
     * @param string $quantity amount of product, expected as xx.yy. Done as string to avoid issues with floating point precision.
     */
    public function calculateSellingPrice(int $productId, string $quantity) :string
    {
        return '1.00';
    }
}
