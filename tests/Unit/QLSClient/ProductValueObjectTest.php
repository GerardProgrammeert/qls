<?php

namespace Tests\Unit\QLSClient;

use BeezMaster\QLSClient\Responses\Collection\ProductsCollection;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ProductValueObjectTest extends TestCase
{
    #[test]
    public function it_can_load_products(): void
    {
        $data = json_decode(file_get_contents(
            __DIR__ . '/fixtures/companies-products-200.json'),
            true
        );

        $collection = ProductsCollection::hydrate($data['data']);

        dd($collection2->firstWhere('name', 'Linda'));
        dd($collection->firstWhere('id', 2));
        dd($collection->where('*.id', '=', 2 ));
        $filtered = array_filter($collection->toArray(), function ($item) {
            return $item['id'] === 2;
        });

        dd($filtered[1]['combinations']);
    }
}
