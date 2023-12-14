<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Money\Casts\MoneyCast;

class ProductSale extends Model
{
    use HasFactory;

    public $table = 'product_sale';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'unit_price' => MoneyCast::class,
        'selling_price' => MoneyCast::class,
    ];
}
