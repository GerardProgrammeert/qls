<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ContactTypeEnum;
use App\Models\Order;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject;

class StoreOrderAction extends AbstractOrderAction
{
    public function execute(ShipmentValueObject $shipment): Order
    {
        $orderLines = $this->getShipmentProducts($shipment);
        $receiver = $this->getReceiverContact($shipment);

        $order = new Order();
        $order->save();

        $order->orderLines()->createMany($orderLines);

        $order->contacts()->create(array_merge(['type' => ContactTypeEnum::RECEIVER->value], $receiver));

        return $order;
    }

    private function store(): void
    {
        //todo
//        try {
//            $result = DB::transaction(function () use ($request, $message) {
//                // execute query 1
//                // execute query 2
//                // ..
//            });
//            // redirect the page
//            return redirect(route('account.article'));
//        } catch (\Exception $e) {
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }
    }
}
