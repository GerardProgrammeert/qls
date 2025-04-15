<?php

namespace Tests\Feature;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use setasign\Fpdi\Fpdi;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    #[test]
    public function it2_can_load_a_shipment(): void
    {

        $data = [
            'billing' => [
                'companyname' => 'd',
                'name' => 's',
                'street' => 's',
                'housenumber' => 's',
                'address_line_2' => 's',
                'postalcode' => 's',
                'locality' => 's',
                'email' => 'gwjvanhattem@gmail.com',
                'phone' => 's',
                'country' => 'NL',
            ],
            'receiver_contact'  => [
                'companyname' => 'd',
                'name' => 's',
                'street' => 's',
                'housenumber' => 's',
                'address_line_2' => 's',
                'postalcode' => 's',
                'locality' => 's',
                'email' => 'gwjvanhattem@gmail.com',
                'phone' => 's',
                'country' => 'NL',
            ],
            'same_as_billing' => true,
            'product_combination_id' => 3,
        ];


        if (Arr::get($data, 'same_as_billing')) {
            $data['receiver_contact'] = $data['billing'];
        }


        $defaultData = [
            'brand_id' => config('qls-client.brand_id'),
            'reference' => time(),
        ];

        $data['shipment_products'] = [
            [
                'amount' => 1,
                'name'  => 'kunstraat',
            ],
            [
                'amount' => 1,
                'name'  => 'broedraam',
            ]
        ];

        $data = array_merge($data, $defaultData);

        $shipment = ShipmentValueObject::hydrate($data);
        dd($shipment->toArray());
    }

    #[test]
    public function it_can_merge_two_pdfs(): void
    {
        $pathLabel = Storage::path('shipment_labels/8d4cb828-ea1e-4d90-bfee-80adccd169ac_label.pdf');
        $label = Pdf::loadHTML('<h1>Shipment label</h1>');
        file_put_contents($pathLabel, $label->output());

        $pathPackage = Storage::path('pdfs/1744644981.pdf');
        $package = Pdf::loadHTML('<h1>Package</h1>');
        file_put_contents($pathPackage, $label->output());

        $path = storage_path('app/test.pdf');
        file_put_contents($path, $pdf->output());

        // Just to be sure
        $this->assertFileExists($path);

//        $merger = new Fpdi();
//
//// Paths to the PDFs
//        $pdfs = [$package, $label];
//
//        $merger->AddPage();
//
//// Import first PDF (external)
//        $pageCount = $merger->setSourceFile($pdfs[0]);
//        $template1 = $merger->importPage(1);
//        $size1 = $merger->getTemplateSize($template1);
//
//// Import second PDF (generated)
//        $pageCount = $merger->setSourceFile($pdfs[1]);
//        $template2 = $merger->importPage(1);
//        $size2 = $merger->getTemplateSize($template2);
//
//// Draw both templates (side-by-side or stacked)
//        $merger->useTemplate($template1, 0, 0, $size1['width'], $size1['height']);
//        $merger->useTemplate($template2, $size1['width'], 0, $size2['width'], $size2['height']);  // Adjust position for second PDF
//
//       $merger->Output($finalPdfPath, 'F');
//        $merger->Output('F', $finalPdfPath);

        $fpdi = new Fpdi();

// Add a new page
        $fpdi->AddPage();

// Import the first page of the external PDF
        $pageCount1 = $fpdi->setSourceFile($pathPackage);
        $templateId1 = $fpdi->importPage(1);
        $fpdi->useTemplate($templateId1);

// Optional: Add a second template on the same page (careful with layout/overlap)
        $pageCount2 = $fpdi->setSourceFile($pathLabel);
        $templateId2 = $fpdi->importPage(1);
        $fpdi->useTemplate($templateId2, 0, 150); // Place second one lower on the same page

// Output the final PDF to a file
        $fpdi->Output('F', $pathFinalPDF);
    }

    #[test]
    public function test_orders_factory(): void
    {
        $order = Order::factory()->create();

        dump($order->orderLines);
    }
}
