<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\OrderLine;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

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

    public function mergePDFS(int $orderId, string $shipmentId): ?string
    {
        $fpdi = new Fpdi();

        $fpdi->setSourceFile($this->getPath(self::ORDERS_LABELS . '/' . $shipmentId . '.pdf'));
        $templateIdLabel = $fpdi->importPage(1);
        $sizeLabel = $fpdi->getTemplateSize($templateIdLabel);

        $fpdi->setSourceFile($this->getPath(self::ORDERS_PACKAGES . '/' . $orderId . '.pdf'));
        $templateIdPackage = $fpdi->importPage(1);
        $sizePackage = $fpdi->getTemplateSize($templateIdPackage);

        $totalHeight = $sizeLabel['height'] + $sizePackage['height'];
        $pageWidth = max($sizeLabel['width'], $sizePackage['width']);
        $fpdi->AddPage('P', [$pageWidth, $totalHeight]);
        $fpdi->useTemplate($templateIdPackage, 0, 0);

        $labelX = ($pageWidth - $sizeLabel['width']) / 2;
        $labelY = $sizePackage['height'];

        $fpdi->useTemplate($templateIdLabel, $labelX, $labelY);


        $targetPath = Storage::path(self::ORDERS_LABELS_PACKAGES . '/' . $orderId . '_' . $shipmentId . '.pdf');
        $fpdi->Output('F', $targetPath);

        return $targetPath;
    }

    private function getPath(string $path): ?string
    {
        return Storage::path($path);
    }

    /**
     *@param array<string, int|null|string> $data
     */
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
