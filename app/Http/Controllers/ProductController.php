<?php

namespace App\Http\Controllers;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\ProductQuantityPriceDTO;
use App\Http\Requests\CalculateSellingPriceRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    public function index()
    {
        return ProductResource::collection(Product::all());

        //return response()->json([
        //    ['label' => 'Gold', 'value' => 1],
        //    ['label' => 'Arabic','value' => 2]
        //]);
    }

    public function calculateSellingPrice(CalculateSellingPriceRequest $request, Product $product)
    {
        $service = new ProductService();
        $unitCost = new Money(trim($request->unit_cost, '.,'), new Currency('GBP'), true);

        $dto = new ProductQuantityPriceDTO($product, $request->quantity, $unitCost);

        return $service->calculateSellingPrice($dto)->format();
    }
}
