<?php

declare(strict_types=1);

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

        $products = ProductsCollection::hydrate($data['data']);

        $combinations = [];
        foreach ($products as $product) {
            $combinations = array_merge($combinations, $product->toArray()['combinations'] ?? []);
        }

        $this->assertCount(10, $combinations);
    }
}
