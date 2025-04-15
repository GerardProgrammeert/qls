<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PdfServiceTest extends TestCase
{
    private PDFService $pdfService;
    const ORDERS =  'orders';
    const ORDERS_LABELS = 'orders/labels';
    const ORDERS_PACKAGES = 'orders/packages';
    const ORDERS_LABELS_PACKAGES = 'orders/labels_packages';
    const SHIPMENT_ID = '8d4cb828-ea1e-4d90-bfee-80adccd169ac';
    const ORDER_ID =  '123456789';

    protected function setUp(): void
    {
        parent::setUp();
        $this->pdfService = new PdfService();
    }

    #[test]
    public function it_can_generate_pdf(): void
    {
        Storage::fake();

        $data = [
           'column1' => 50,
           'column2' => null,
           'column3' => 'string',
        ];
        $path = $this->pdfService->generatePackage($data, self::ORDER_ID);

        Storage::assertExists($path);
    }
    #[test]
    public function it_can_merge_package_and_label_pdfs(): void
    {
        //Storage::fake();
        $this->getPPDFs();
        $this->pdfService->mergePDFS(self::ORDER_ID, self::SHIPMENT_ID);
    }

    private function getPPDFs(): void
    {
       // Storage::fake();
        $pathLabel = self::ORDERS_LABELS . '/' . self::SHIPMENT_ID . '.pdf';
        dump(Storage::path($pathLabel));
        $label = Pdf::loadHTML('<h1>Shipment label</h1>');
        Storage::put($pathLabel, $label->output());

        $pathPackage = Storage::path(self::ORDERS_PACKAGES . '/' . self::ORDER_ID . '.pdf');
        $package = Pdf::loadHTML('<h1>Package</h1>');
        Storage::put($pathPackage, $package->output());
        sleep(2);
    }
}
