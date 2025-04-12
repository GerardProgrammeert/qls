<?php

namespace BeezMaster\QLSClient;

Enum CustomsShipmentTypes: string
{
    case COMMERCIAL = 'commercial';
    case DOCUMENTS = 'documents';
    case RETURN = 'return';
    case SAMPLE = 'sample';
}
