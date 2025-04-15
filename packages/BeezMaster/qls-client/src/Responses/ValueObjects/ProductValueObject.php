<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

use BeezMaster\QLSClient\Responses\Collections\ProductCombinationsCollection;
use BeezMaster\QLSClient\Responses\Collections\ProductOptionsCollection;
use BeezMaster\QLSClient\Responses\Collections\ProductPricingsCollection;

final readonly class ProductValueObject extends AbstractValueObject
{
    public function __construct(
        private int $id,
        private string $name,
        private string $type,
        private bool $servicePoint,
        private int $maxHeight,
        private int $maxLength,
        private int $maxWidth,
        private ProductPricingsCollection $pricing,
        private ProductOptionsCollection $options,
        private ProductCombinationsCollection $combinations
    )
    {
    }

    public static function hydrate(array $data): self
    {
        $args = [
            'id' => self::parseAsInteger($data, 'id'),
            'name' => self::parseAsString($data, 'name'),
            'type' => self::parseAsString($data, 'type'),
            'servicePoint' => self::parseAsBoolean($data, 'servicepoint'),
            'maxHeight' => self::parseAsInteger($data, 'max_height'),
            'maxLength' => self::parseAsInteger($data, 'max_length'),
            'maxWidth' => self::parseAsInteger($data, 'max_width'),
            'pricing' => self::parseAsPricingCollection($data, 'pricing'),
            'options' => self::parseAsOptionsCollection($data, 'options'),
            'combinations' => self::parseAsCombinationCollection($data, 'combinations'),
        ];

        return new self(...$args);
    }

    public function getId(): int
    {
        return $this->id;
    }

    private static function parseAsPricingCollection(array $data, string $key): ProductPricingsCollection
    {
        $collection = new ProductPricingsCollection();
        if (!array_key_exists($key, $data)) {
            return $collection;
        }

        foreach ($data[$key] as $item) {
            $collection->push(ProductPricingValueObject::hydrate($item));
        }

        return $collection;
    }

    private static function parseAsOptionsCollection(array $data, string $key): ProductOptionsCollection
    {
        $collection = new ProductOptionsCollection();
        if (!array_key_exists($key, $data)) {
            return $collection;
        }

        foreach ($data[$key] as $item) {
            $collection->push(ProductOptionValueObject::hydrate($item));
        }

        return $collection;
    }

    private static function parseAsCombinationCollection(array $data, string $key)
    {
        $collection = new ProductCombinationsCollection();
        if (!array_key_exists($key, $data)) {
            return $collection;
        }

        foreach ($data[$key] as $item) {
            $collection->push(ProductCombinationValueObject::hydrate($item));
        }

        return $collection;
    }

    /**
     *@return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'servicepoint' => $this->servicePoint,
            'max_height' => $this->maxHeight,
            'max_length' => $this->maxLength,
            'max_width' => $this->maxWidth,
            'pricing' => $this->pricing->toArray(),
            'options' => $this->options->toArray(),
            'combinations' => $this->combinations->toArray(),
        ];
    }
}
