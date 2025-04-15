<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient;

use BeezMaster\QLSClient\Clients\ClientInterface;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject;
use BeezMaster\QLSClient\Responses\GetProductsResponse;
use BeezMaster\QLSClient\Responses\PostShipmentResponse;
use Illuminate\Support\Facades\Storage;

final readonly class QLSService
{
    public function __construct(private ClientInterface $client)
    {
    }

    public function getProducts(string $companyId): GetProductsResponse
    {
        $url = sprintf(Endpoints::COMPANY_PRODUCTS->value, $companyId);
        $rawResponse = $this->client->get($url);

        return new GetProductsResponse($rawResponse);
    }

    public function getShipmentLabel(string $companyId, string $shipmentId): void
    {
        $url = sprintf(Endpoints::SHIPMENT->value, $companyId, $shipmentId);
        $path1 = '/orders/labels/' . $shipmentId . '.pdf';
        $rawResponse = $this->client->get($url);
        $data = json_decode($rawResponse->getBody()->getContents(), true);

        if (isset($data['data'])) {
            $pdf = base64_decode($data['data']);
            Storage::put($path1, $pdf);
        }
    }

    public function postShipment(string $companyId, ShipmentValueObject $shipment): PostShipmentResponse
    {
        $url = sprintf(Endpoints::CREATE_SHIPMENT->value, $companyId);
        return new PostShipmentResponse ($this->client->post( $url, ['json' => $shipment->toArray()]));
    }
}
