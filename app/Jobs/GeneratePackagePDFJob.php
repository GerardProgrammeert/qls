<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\PdfService;

class GeneratePackagePDFJob extends AbstractOrderJob
{
    public function handle(PdfService $service): void
    {
        $order = $this->getOrder($this->orderId);

        $this->started([
            'order' => $order->id,
            'shipment_id ' => $order->shipment_id,
        ]);

        $service->generatePackage($order);

        $this->finished([
            'order' => $order->id,
            'shipment_id ' => $order->shipment_id,
        ]);

        MergePDFsJob::dispatch($this->orderId);
    }
}
