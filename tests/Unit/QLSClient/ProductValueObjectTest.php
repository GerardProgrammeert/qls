<?php

namespace Tests\Unit\QLSClient;

use BeezMaster\QLSClient\Responses\Collections\ProductsCollection;
use BeezMaster\QLSClient\Responses\ValueObjects\ShipmentValueObject;
use Illuminate\Support\MessageBag;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ProductValueObjectTest extends TestCase
{
    #[test]
    public function it_can_load_products(): void
    {
        $data = json_decode(
            file_get_contents(
                __DIR__ . '/fixtures/companies-products-200.json'
            ),
            true
        );

        $collection = ProductsCollection::hydrate($data['data']);

        dd($collection->firstWhere('name', 'Linda'));
        dd($collection->firstWhere('id', 2));
        dd($collection->where('*.id', '=', 2));
        $filtered = array_filter($collection->toArray(), function ($item) {
            return $item['id'] === 2;
        });

        dd($filtered[1]['combinations']);
    }

    #[test]
    public function it_can_load_a_shipment(): void
    {
        $data = json_decode(
            file_get_contents(
                __DIR__ . '/fixtures/shipment-products-201.json'
            ),
            true
        );

        $collection = ShipmentValueObject::hydrate($data['data']);
    }

    #[test]
    public function it_can_read_error_json_shipment(): void
    {
        $validationErrors = null;
        $response = json_decode(
            file_get_contents(__DIR__ . '/fixtures/shipment-products-400.json'),
            true
        );

     //   dd($response);
        $errors  = $errors = data_get($response, 'errors') ?? [];

        $parsedErrors = [];
        foreach ($errors as $fields) {
            foreach ($fields as $key => $errors) {
                $parsedErrors[$key] = implode(',', $errors);
            }
        }
        $validationErrors = new MessageBag([
            $parsedErrors
        ]);

        dump($validationErrors);
    }
}
