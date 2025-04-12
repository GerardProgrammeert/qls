<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Repositories;

use BeezMaster\QLSClient\QLSService;
use BeezMaster\QLSClient\Responses\Collection\ProductsCollection;
use BeezMaster\QLSClient\Responses\GetProductsResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductsRepository
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

    public function getByProductId(int $id): ?ProductsCollection
    {
        $products = $this->all();

        return $products->filter(fn($item) => $item->getId() === $id);
    }

    public function refresh(): void
    {
        Cache::forget($this->cacheKey);
        $this->products = null;
    }
}
