<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ContactTypeEnum;
use App\Models\Order;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject;
use Illuminate\Support\Facades\DB;

class StoreOrderAction extends AbstractOrderAction
{
    public function execute(ShipmentValueObject $shipment): Order
    {
        return DB::transaction(function () use ($shipment) {
            $orderLines = $this->getShipmentProducts($shipment);
            $receiver = $this->getReceiverContact($shipment);

            $order = new Order();
            $order->save();

            $order->orderLines()->createMany($orderLines);

            $order->contacts()->create(array_merge(
                ['type' => ContactTypeEnum::RECEIVER->value],
                $receiver
            ));

            return $order;
        });
    }
}
