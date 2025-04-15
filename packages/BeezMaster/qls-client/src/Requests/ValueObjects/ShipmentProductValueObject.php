<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Requests\ValueObjects;

use BeezMaster\QLSClient\Responses\ValueObjects\AbstractValueObject;

final readonly class ShipmentProductValueObject extends AbstractValueObject
{
    public function __construct(
        private int $amount,
        private string $name,
        private ?string $countryCodeOfOrigin,
        private ?string $hsCode,
        private ?float $pricePerUnit,
        private ?float $weightPerUnit,
        private ?string $ean,
        private ?string $sku,
        private ?string $currency
    )
    {
    }

    public static function hydrate(array $data): self
    {
        $args = [
            'amount' => self::parseAsInteger($data, 'amount'),
            'name' =>self::parseAsString($data, 'name'),
            'countryCodeOfOrigin' => self::parseAsNullableString($data, 'country_code_of_origin'),
            'hsCode' => self::parseAsNullableString($data,'string'),
            'pricePerUnit' => self::parseAsNullableFloat($data, 'price_per_unit'),
            'weightPerUnit' => self::parseAsNullableFloat($data, 'weight_per_unit'),
            'ean' => self::parseAsNullableString($data, 'ean'),
            'sku' => self::parseAsNullableString($data, 'sku'),
            'currency' => self::parseAsNullableString($data, 'currency'),
        ];

        return new self(...$args);
    }

    /**
     *@return array<string, null|string|float|int>
     */
    public function toArray(): array
    {
        $data = [
            'amount' => $this->amount,
            'name' => $this->name,
            'country_code_of_origin' => $this->countryCodeOfOrigin,
            'hs_code' => $this->hsCode,
            'price_per_unit' => $this->pricePerUnit,
            'weight_per_unit' => $this->weightPerUnit,
            'ean' => $this->ean,
            'sku' => $this->sku,
            'currency' => $this->currency,
        ];

        return array_filter($data);
    }
}
