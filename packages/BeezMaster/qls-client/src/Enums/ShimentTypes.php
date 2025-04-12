<?php

namespace BeezMaster\QLSClient;

Enum ShipmentTypes: string
{
    case DELIVERY = 'delivery';
    case RETURN = 'return';
    case PICKUP = 'pickup';
}
