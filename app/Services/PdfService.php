<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\OrderLine;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfService
{
    const ORDERS =  'orders';
    const ORDERS_LABELS = 'orders/labels';
    const ORDERS_PACKAGES = 'orders/packages';
    const ORDERS_LABELS_PACKAGES = 'orders/labels_packages';

    public function __construct()
    {
        $this->init();
    }

    public function init(): void
    {
        $folders = [ self::ORDERS, self::ORDERS_LABELS, self::ORDERS_PACKAGES, self::ORDERS_LABELS_PACKAGES];

        foreach ($folders as $folder) {
            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }
        }
    }

    public function mergePDFS(Order $order): ?string
    {
        if (!$order->shipment_id) {
            return null;
        }

        $fpdi = new Fpdi();

        $fpdi->setSourceFile($this->getAbsolutePath($this->getPathLabels($order)));
        $templateIdLabel = $fpdi->importPage(1);
        $sizeLabel = $fpdi->getTemplateSize($templateIdLabel);

        $fpdi->setSourceFile($this->getAbsolutePath($this->getPathPackages($order)));
        $templateIdPackage = $fpdi->importPage(1);
        $sizePackage = $fpdi->getTemplateSize($templateIdPackage);

        $totalHeight = $sizeLabel['height'] + $sizePackage['height'];
        $pageWidth = max($sizeLabel['width'], $sizePackage['width']);
        $fpdi->AddPage('P', [$pageWidth, $totalHeight]);
        $fpdi->useTemplate($templateIdPackage);

        $labelX = ($pageWidth - $sizeLabel['width']) / 2;
        $labelY = $sizePackage['height'];

        $fpdi->useTemplate($templateIdLabel, $labelX, $labelY);

        $targetPath = $this->getPathLabelsPackages($order);
        $fullTargetPath = $this->getAbsolutePath($targetPath);
        $fpdi->Output('F', $fullTargetPath);
        logger('hello');
        return $targetPath;
    }

    private function getPathLabels(Order $order): ?string
    {
        if (!$order->shipment_id) {
            return null;
        }

        return self::ORDERS_LABELS . '/'. $order->shipment_id . '.pdf';
    }

    private function getPathPackages(Order $order): ?string
    {
        if (!$order->shipment_id) {
            return null;
        }

        return self::ORDERS_PACKAGES . '/' . $order->id . '.pdf';
    }


    private function getPathLabelsPackages(Order $order): ?string
    {
        if (!$order->shipment_id) {
            return null;
        }

        return self::ORDERS_LABELS_PACKAGES . '/' . $order->id . '_' . $order->shipment_id . '.pdf';
    }

    public function downloadShipmentPackagePDF(Order $order): StreamedResponse
    {
        $path = $this->getPathLabelsPackages($order);

        return Storage::exists($path)
            ? Storage::download($path)
            :  abort(404, 'PDF not found.');
    }

    private function getAbsolutePath(string $path): ?string
    {
        return Storage::path($path);
    }

    public function generatePackage(Order $order): ?string
    {
        $data = $order->orderLines?->map(function (OrderLine $orderLine) {
            return  [
                'name' => $orderLine->name,
                'amount' => $orderLine->amount,
                'price_per_unit' => $orderLine->price_per_unit / 100 ,
                'total' => $orderLine->amount * $orderLine->price_per_unit / 100,
            ];
        })->toArray();

        $fields = array_keys($data[0] ?? null);

        $target = self::ORDERS_PACKAGES . '/' . $order->id . '.pdf';
        $pdf = Pdf::loadView('pdf.table', compact('data', 'fields', 'order'));

        Storage::put($target, $pdf->output());

        return $target;
    }
}
