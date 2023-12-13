<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateSellingPriceRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{

    public function calculateSellingPrice(CalculateSellingPriceRequest $request, Product $product)
    {
        $service = new ProductService();
        return $service->calculateSellingPrice($product->id, $request->quantity);
    }
}
