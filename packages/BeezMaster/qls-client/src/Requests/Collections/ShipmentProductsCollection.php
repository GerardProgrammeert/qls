<?php

namespace BeezMaster\QLSClient\Requests\Collections;

use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentProductValueObject;
use BeezMaster\QLSClient\Responses\Collections\AbstractCollection;

/**
 * @template TKey of int
 * @template TModel of ShipmentProductValueObject
 *
 * @extends AbstractCollection
 */
class ShipmentProductsCollection extends AbstractCollection
{
    protected string $className = ShipmentProductValueObject::class;
}
