<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses;

use BeezMaster\QLSClient\Responses\ValueObjects\ShipmentValueObject;
use BeezMaster\QLSClient\ValueObjects\AbstractValueObject;

final class PostShipmentResponse extends AbstractResponse implements HasGetValueObjectInterface
{
    public function getValueObject(): AbstractValueObject
    {
        return ShipmentValueObject::hydrate($this->data['data'] ?? null);
    }
}
