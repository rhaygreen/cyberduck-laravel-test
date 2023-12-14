<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateSellingPriceRequest;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Sale;
use App\Services\SaleService;
use App\Models\Product;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\DTOs\ProductQuantityPriceDTO;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $product = Product::findOrFail($request->id_product);
        $service = new SaleService();
        $unitCost= new Money(trim($request->unit_cost,".,"), new Currency('GBP'), true);
        $dto = new ProductQuantityPriceDTO($product, $request->quantity, $unitCost);
        return $service->createSale($dto);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
