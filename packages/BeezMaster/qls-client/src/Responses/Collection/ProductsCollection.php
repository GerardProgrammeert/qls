<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\Collection;

use BeezMaster\QLSClient\Responses\ValueObjects\ProductValueObject;

/**
 * @template TKey of int
 * @template TModel of ProductValueObject
 *
 * @extends AbstractCollection
 */
final class ProductsCollection extends AbstractCollection
{
    protected string $className = ProductValueObject::class;
}
