<?php

namespace App\Http\Controllers;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\ProductQuantityPriceDTO;
use App\Http\Requests\CalculateSellingPriceRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function calculateSellingPrice(CalculateSellingPriceRequest $request, Product $product)
    {
        $service = new ProductService();
        $unitCost = new Money(trim($request->unit_cost, '.,'), new Currency('GBP'), true);

        $dto = new ProductQuantityPriceDTO($product, $request->quantity, $unitCost);

        return response()->json($service->calculateSellingPrice($dto)->format());
    }
}
