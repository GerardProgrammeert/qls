<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Enums;

Enum ShipmentTypes: string
{
    case DELIVERY = 'delivery';
    case RETURN = 'return';
    case PICKUP = 'pickup';
}
