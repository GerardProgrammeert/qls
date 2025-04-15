<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Order;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject as ShipmentRequestValueObject;
use BeezMaster\QLSClient\Responses\ValueObjects\ShipmentValueObject as ShipmentResponseValueObject;

abstract class AbstractOrderAction
{
    /**
     *@return array<int, array<string, int,string,null>>
     */
    protected function getShipmentProducts(ShipmentRequestValueObject|ShipmentResponseValueObject $shipment): array
    {
        $data = $shipment->toArray();
        $orderLines = data_get($data, 'shipment_products.data');

        return $orderLines;
    }

    /**
     *@return array<int, array<string, mixed>>
     */
    protected function getReceiverContact(ShipmentRequestValueObject|ShipmentResponseValueObject $shipment): array
    {
        $data = $shipment->toArray();
        $orderLines = data_get($data, 'receiver_contact');

        return $orderLines;
    }

    protected function getOrder(int $orderId): Order
    {
        return Order::query()->with(['orderLines', 'contacts'])->findOrFail($orderId);
    }

    protected function getShipmentId(ShipmentRequestValueObject|ShipmentResponseValueObject $shipment): ?string
    {
        $data = $shipment->toArray();

        return data_get($data, 'id');
    }

    protected function getProductCombinationId(
        ShipmentRequestValueObject|ShipmentResponseValueObject $shipment
    ): ?int {
        $data = $shipment->toArray();

        return data_get($data, 'product_combination_id');
    }
}
