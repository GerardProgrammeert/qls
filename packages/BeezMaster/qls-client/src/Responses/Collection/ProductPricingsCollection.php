<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\Collection;

use BeezMaster\QLSClient\Responses\ValueObjects\ProductPricingValueObject;

/**
 * @template TKey of int
 * @template TModel of ProductPricingValueObject
 *
 * @extends AbstractCollection
 */
final class ProductPricingsCollection extends AbstractCollection
{
    protected string $className = ProductPricingValueObject::class;
}
