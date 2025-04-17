<?php

declare(strict_types=1);

namespace App\Jobs;

use BeezMaster\QLSClient\QLSService;
use Exception;
use Illuminate\Support\Facades\Log;

class DownloadShipmentLabelJob extends AbstractOrderJob
{
    public function handle(QLSService $service): void
    {
        $order = $this->getOrder($this->orderId);

        $this->started(['order' => $order->id,]);

        try {
            retry(3, function () use ($service, $order) {
                $service->getShipmentLabel(config('qls-client.company_id'), $order->shipment_id);
            }, 1000);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), ['shipment_id' => $order->shipment_id]);
        }

        $this->finished(['order' => $order->id,]);

        GeneratePackagePDFJob::dispatch($order->id);
    }
}
