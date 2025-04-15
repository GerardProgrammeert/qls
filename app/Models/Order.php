<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ContactTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 *@property ?int $id
 *@property ?string $shipment_id
 *@property ?int $product_combination_id
 *@property Collection<int, Contact> $contacts
 *@property Collection<int, OrderLine> $orderLines
 */
class Order extends BaseModel
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'country',
        'product_combination_id',
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function receiverContact(): hasOne
    {
        return $this->hasOne(Contact::class)->where('type', ContactTypeEnum::RECEIVER);
    }
}
