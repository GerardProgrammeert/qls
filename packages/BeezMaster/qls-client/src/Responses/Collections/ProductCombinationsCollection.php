<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\Collections;

use BeezMaster\QLSClient\Responses\ValueObjects\ProductCombinationValueObject;

/**
 * @template TKey of int
 * @template TModel of ProductCombinationValueObject
 *
 * @extends AbstractCollection
 */
class ProductCombinationsCollection extends AbstractCollection
{
    protected string $className = ProductCombinationValueObject::class;
}
