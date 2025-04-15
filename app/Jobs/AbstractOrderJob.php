<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use RuntimeException;

abstract class AbstractOrderJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected string $className;

    public function __construct(protected readonly int $orderId)
    {
        $this->className = class_basename($this);
    }

    protected function getOrder(int $orderId): Order
    {
        $order = Order::query()->with('orderLines')->find($orderId);

        if (!$order) {
            $messageOrder = "Order $orderId not found";
            Log::error($messageOrder, ['order_id' =>  $orderId]);
            throw new RuntimeException($messageOrder);
        }

        if (!$order->shipment_id) {
            $messageShipment = "No shipment id not found for order $orderId";
            Log::error($messageShipment, ['order_id' => $orderId]);
            throw new RuntimeException($messageShipment);
        }

        return $order;
    }

    /**
     *@param array<string, mixed>
     */
    protected function started(array $context = []): void
    {
        Log::info("Started job $this->className", $context);
    }

    /**
     *@param array<string, mixed>
     */
    protected function finished(array $context = []): void
    {
        Log::info("Finished job $this->className", $context);
    }
}
