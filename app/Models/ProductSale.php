<?php

namespace App\Models;

use Akaunting\Money\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSale extends Model
{
    use HasFactory;

    public $table = 'product_sale';

    public $hidden = ['id', 'sale_id', 'product_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'unit_cost' => MoneyCast::class,
        'selling_price' => MoneyCast::class,
        'created_at' => 'datetime: Y-m-d H:i:s',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
