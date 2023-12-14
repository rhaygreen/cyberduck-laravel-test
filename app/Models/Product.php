<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Money\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public $hidden = ['id','laravel_through_key'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'shipping_cost' => MoneyCast::class,
    ];

    public function productSales(): HasMany
    {
        return $this->hasMany(ProductSale::class);
    }
}
