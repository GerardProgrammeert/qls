<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Repositories;

use BeezMaster\QLSClient\QLSService;
use BeezMaster\QLSClient\Responses\Collections\ProductsCollection;
use BeezMaster\QLSClient\Responses\GetProductsResponse;
use BeezMaster\QLSClient\Responses\ValueObjects\ProductValueObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    private ?ProductsCollection $products = null;

    public function __construct(private string $companyId, private string $cacheKey, private int $ttl = 60)
    {
    }

    public function all(): ?ProductsCollection
    {
        if ($this->products !== null) {
            return $this->products;
        }

        return Cache::remember($this->cacheKey, $this->ttl, function () {
            $service = app()->make(QLSService::class);
            try {
                $response = retry(4, function () use ($service): GetProductsResponse {
                    return $service->getProducts($this->companyId);
                }, 1000);
            }
            catch (\Exception $e) {
                Log::warning('Failed to fetch products from QLSService', [
                    'company_id' => $this->companyId,
                    'error' => $e->getMessage(),
                ]);

               return null;
            }

            return $response?->getCollection();
        });
    }

    public function getCombinationsByProduct(int $productId):?array
    {
        /** @var ?ProductValueObject $product */
        $product = $this->getByProductId($productId)?->first();

        return data_get($product?->toArray(), 'combinations');
    }
    public function allProductCombinations(): Collection
    {
        $products = $this->all();
        $combinations = [];
        foreach ($products as $product) {
            $combinations = array_merge($combinations, $product->toArray()['combinations'] ?? []);
        }

        return collect($combinations);
    }

    public function getByProductId(int $id): ?ProductsCollection
    {
        $products = $this->all();

        return $products?->filter(fn($item) => $item->getId() === $id);
    }

    public function refresh(): void
    {
        Cache::forget($this->cacheKey);
        $this->products = null;
    }
}
