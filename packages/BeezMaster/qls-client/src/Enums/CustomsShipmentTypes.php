<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Enums;

Enum CustomsShipmentTypes: string
{
    case COMMERCIAL = 'commercial';
    case DOCUMENTS = 'documents';
    case RETURN = 'return';
    case SAMPLE = 'sample';
}
