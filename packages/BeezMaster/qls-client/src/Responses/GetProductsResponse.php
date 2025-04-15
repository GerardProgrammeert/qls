<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses;

use BeezMaster\QLSClient\Responses\Collections\ProductsCollection;
use Illuminate\Support\Collection;

final class GetProductsResponse extends AbstractResponse implements HasGetCollectionInterface
{
    public function getCollection(): Collection
    {
        return ProductsCollection::hydrate($this->data['data'] ?? []);
    }
}
