<?php

namespace App\Services;

use App\DTOs\ProductQuantityPriceDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\ProductSale;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductService;


class SaleService
{
    public function createSale(ProductQuantityPriceDTO $dto)
    {
        $productService = new ProductService();
        $sellingPrice = $productService->calculateSellingPrice($dto);

        //within a transaction,
        //create the sale, and create the product sale record.
        DB::transaction(function () use ($dto, $sellingPrice) {
            $sale = new Sale();
            $sale->user_id = Auth::id();
            $sale->save();

            $productSale = new ProductSale();
            $productSale->sale_id = $sale->id;
            $productSale->product_id = $dto->getProduct()->id;
            $productSale->quantity = $dto->getQuantity();
            $productSale->unit_cost = $dto->getUnitPrice();
            $productSale->selling_price = $sellingPrice;

            $productSale->save();

        }, 5);
    }
}
