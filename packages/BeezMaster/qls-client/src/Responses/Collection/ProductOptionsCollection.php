<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\Collection;

use BeezMaster\QLSClient\Responses\ValueObjects\ProductOptionValueObject;

/**
 * @template TKey of int
 * @template TModel of ProductOptionValueObject
 *
 * @extends AbstractCollection
 */
final class ProductOptionsCollection extends AbstractCollection
{
    protected string $className = ProductOptionValueObject::class;
}
