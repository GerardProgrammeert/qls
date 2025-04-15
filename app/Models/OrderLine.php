<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property ?int $id
 * @property int $amount
 * @property int $price_per_unit
 * @property string $name
 * @property Order $order
 * @property Product $product
 */
class OrderLine extends BaseModel
{
    /** @use HasFactory<\Database\Factories\OrderLineFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'amount',
        'price_per_unit',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
