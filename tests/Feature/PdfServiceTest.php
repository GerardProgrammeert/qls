<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Order;
use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PdfServiceTest extends TestCase
{
    private PDFService $pdfService;
    const ORDERS_LABELS = 'orders/labels';
    const ORDERS_PACKAGES = 'orders/packages';
    const ORDERS_LABELS_PACKAGES = 'orders/labels_packages';

    protected function setUp(): void
    {
        parent::setUp();
        $this->pdfService = new PdfService();
    }

    #[test]
    public function it_can_generate_package_pdf(): void
    {
        Storage::fake();

        $order = Order::factory()->create();

        $path = $this->pdfService->generatePackage($order);

        Storage::assertExists($path);
    }
    #[test]
    public function it_can_merge_package_and_label_pdfs(): void
    {
        $order = Order::factory()->create();
        $this->getPPDFs($order);
        $path = $this->pdfService->mergePDFS($order);

        Storage::assertExists($path);
    }

    private function getPPDFs(Order $order): void
    {
        $pathLabel = self::ORDERS_LABELS . '/' . $order->shipment_id . '.pdf';
        $label = Pdf::loadHTML('<h1>Shipment label</h1>');
        Storage::put($pathLabel, $label->output());
        $this->pdfService->generatePackage($order);
    }
}
