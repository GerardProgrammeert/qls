<?php

declare(strict_types=1);

namespace QLSClient;

use BeezMaster\QLSClient\Responses\ValueObjects\ShipmentValueObject;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShipmentValueObjectTest extends TestCase
{
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
        $this->assertCount(8, $collection->toArray()['shipment_products']['data'] ?? []);
    }
}
