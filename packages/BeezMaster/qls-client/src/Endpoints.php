<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient;

/**
 * @see https://api.pakketdienstqls.nl/redoc/
 * @see https://api.pakketdienstqls.nl/swagger
 */
Enum Endpoints: string
{

    case COMPANY_PRODUCTS = '/companies/%s/products';

    case CREATE_SHIPMENT = '/v2/companies/%s/shipments';

    case SHIPMENT = '/v2/companies/%s/shipments/%s/labels/pdf';
}
