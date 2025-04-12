<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient;

/**
 * @see https://api.pakketdienstqls.nl/redoc/
 * @see https://api.pakketdienstqls.nl/swagger
 */
Enum Endpoints: string
{
    /**
     * Replace `%s` with the company ID.
     */
    case COMPANY_PRODUCTS = '/companies/%s/products';

    /**
     * Replace `%s` with the company ID.
     */

    case CREATE_SHIPMENT = '/v2/companies/%s/shipments';
}
