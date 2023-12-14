<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Sale extends Model
{
    use HasFactory;

    public $table = 'sales';

    public $hidden = ['id'];

    public function productSales(): HasMany
    {
        return $this->hasMany(ProductSale::class);
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            ProductSale::class,
            'product_id',
            'id',
            'id',
            'sale_id',
        );
    }

}
