<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateSellingPriceRequest;
use App\Models\Product;
use App\Services\ProductService;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\SellingPriceCalculationDTO;

class ProductController extends Controller
{

    public function calculateSellingPrice(CalculateSellingPriceRequest $request, Product $product)
    {
        $service = new ProductService();
        $unitPrice = new Money(trim($request->unit_price,".,"), new Currency('GBP'), true);

        $dto = new SellingPriceCalculationDTO($product, $request->quantity, $unitPrice);
        return $service->calculateSellingPrice($dto)->format();
    }
}
