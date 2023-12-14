<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateSellingPriceRequest;
use App\Models\Product;
use App\Services\ProductService;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\ProductQuantityPriceDTO;

class ProductController extends Controller
{

    public function calculateSellingPrice(CalculateSellingPriceRequest $request, Product $product)
    {
        $service = new ProductService();
        $unitCost = new Money(trim($request->unit_cost,".,"), new Currency('GBP'), true);

        $dto = new ProductQuantityPriceDTO($product, $request->quantity, $unitCost);
        return $service->calculateSellingPrice($dto)->format();
    }
}
