<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient;

use BeezMaster\QLSClient\Clients\ClientInterface;
use BeezMaster\QLSClient\Responses\GetProductsResponse;

final class QLSService
{
    public function __construct(private readonly ClientInterface $client)
    {
    }

    public function getProducts(string $companyId): GetProductsResponse
    {
        $url = sprintf(Endpoints::COMPANY_PRODUCTS->value, $companyId);
        $rawResponse = $this->client->get( $url, []);

        return new GetProductsResponse($rawResponse);
    }
}
