<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

final readonly class ProductOptionValueObject extends AbstractValueObject
{
    public function __construct(
        private int $id,
        private string $name,
        private string $tag,
        private ?float $price
    )
    {
    }

    public static function hydrate(array $data): self
    {
      $args = [
        'id' =>  self::parseAsInteger($data, 'id'),
        'name' =>self::parseAsString($data, 'name'),
        'tag' => self::parseAsString($data, 'tag'),
        'price' => self::parseAsNullableFloat($data, 'price'),
      ];

      return new self(...$args);
    }

    /**
     * @return array<string, int|string|float>
     */
    public function toArray(): array
    {
       return [
           'id' => $this->id,
           'name' => $this->name,
           'tag' => $this->tag,
           'price' => $this->price
       ];
    }
}
