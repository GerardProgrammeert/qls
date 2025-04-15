<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Enums;

 Enum ShipmentStatuses: string
{
    case CREATED = 'created';
    case PRINTED = 'printed';
    case PRE_TRANSIT = 'pre_transit';
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case RETURNED = 'returned';
}
