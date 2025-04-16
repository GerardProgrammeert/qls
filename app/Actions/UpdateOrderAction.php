<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ContactTypeEnum;
use App\Models\Contact;
use App\Models\Order;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject as ShipmentRequestValueObject;
use BeezMaster\QLSClient\Responses\ValueObjects\ShipmentValueObject as ShipmentResponseValueObject;
use Illuminate\Support\Facades\DB;

class UpdateOrderAction extends AbstractOrderAction
{
    public function execute(int $orderId, ShipmentRequestValueObject|ShipmentResponseValueObject $shipment): Order
    {
        return DB::transaction(function () use ($shipment, $orderId) {
            $orderLines = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'amount' => $item['amount'],
                    'price_per_unit' => $item['price_per_unit'],
                ];
            }, $this->getShipmentProducts($shipment));

            $receiver = $this->getReceiverContact($shipment);

            $order = $this->getOrder($orderId);
            $order->shipment_id = $this->getShipmentId($shipment);
            $order->product_combination_id = $this->getProductCombinationId($shipment);
            $order->update();

            /** @var Contact|null $contact */
            $contact = $order->contacts()?->where('type', ContactTypeEnum::RECEIVER->value)->first();

            if ($contact) {
                $contact->update($receiver);
            }

            $order->orderLines()->delete();
            $order->refresh();

            $order->orderLines()->createMany($orderLines);

            return $order;
        });
    }
}
