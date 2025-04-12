<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

//todo validate countries
final readonly class ProductPricingValueObject extends AbstractValueObject
{
    public function __construct(
        private string $country,
        private int $weightMin,
        private int $weightMax,
        private float $price
    )
    {
    }

    public static function hydrate(array $data): self
    {
       $args = [
           'country' => self::parseAsString($data, 'country'),
           'weightMin' => self::parseAsInteger($data, 'weight_min'),
           'weightMax' => self::parseAsInteger($data, 'weight_max'),
           'price' => self::parseAsFloat($data, 'price'),
       ];

       return new self(...$args);
    }

    /**
     *@return array<string, string|int|float>
     */
    public function toArray(): array
    {
       return [
           'country' => $this->country,
           'weight_min' => $this->weightMin,
           'weight_max' => $this->weightMax,
           'price' => $this->price,
       ];
    }
}
