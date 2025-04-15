<?php

declare(strict_types=1);

namespace App\Rules;

use BeezMaster\QLSClient\Repositories\ProductRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductCombinationRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array((int)$value, $this->getProductCombinationIds())) {
            $fail('Invalid product combination id provided.');
        }
    }

    /**
     * @return array<int, int>
     */
    private function getProductCombinationIds(): array
    {
        $productsRepository = app()->make(ProductRepository::class);

        return $productsRepository->allProductCombinations()->pluck('id')->toArray();
    }
}
