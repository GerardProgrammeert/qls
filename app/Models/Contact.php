<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ContactTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property ?int $id
 * @property string $name
 * @property ?string $companyname
 * @property string $street
 * @property string $housenumber
 * @property ?string $address2
 * @property string $postalcode
 * @property string $locality
 * @property string $email
 * @property string $phone
 * @property ContactTypeEnum $type
 * @property strin $country
 */
class Contact extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'companyname',
        'street',
        'housenumber',
        'address2',
        'postalcode',
        'locality',
        'type',
        'email',
        'phone',
        'country',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'type' => ContactTypeEnum::class,
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeDelivery(Builder $query): void
    {
        $query->where('type', ContactTypeEnum::DELIVERY);
    }

    public function scopeReceiver(Builder $query): void
    {
        $query->where('type', ContactTypeEnum::RECEIVER);
    }
}
