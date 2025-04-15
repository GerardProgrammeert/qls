<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property ?int $id
 * @property string $name
 * @property int $price_per_unit
 * @property int $weight_per_unit
 * @property ?string $ean
 * @property ?string $sku
 * @property Collection<int, OrderLine> $orderLines
 */
class Product extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'price_per_unit', //unit: cents
        'weight_per_unit',  //unit: grams
        'ean',
        'sku',
    ];

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }
}
