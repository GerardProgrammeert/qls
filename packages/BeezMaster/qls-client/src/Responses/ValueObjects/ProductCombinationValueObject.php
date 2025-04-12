<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

use BeezMaster\QLSClient\Responses\Collection\ProductOptionsCollection;

final readonly class ProductCombinationValueObject extends AbstractValueObject
{
    public function __construct(
        private int $id,
        private string $name,
        private ProductOptionsCollection $productOptions
    ) {
    }

    public static function hydrate(array $data): self
    {
        $args = [
            'id' => self::parseAsInteger($data, 'id'),
            'name' => self::parseAsString($data, 'name'),
            'productOptions' => self::parseAsProductOptions($data,'product_options'),
        ];

        return new self(...$args);
    }

    private static function parseAsProductOptions(array $data, string $key)
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_options' => $this->productOptions->toArray(),
        ];
    }
}
