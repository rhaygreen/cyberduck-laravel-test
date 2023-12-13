<?php

namespace App\Services;

use App\Http\Requests\StoreSaleRequest;

class SaleService
{
    public function createSale(StoreSaleRequest $request)
    {
        //within a transaction,
        //create the sale, and create the product sale record.
    }
}
