<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, string|integer>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price_per_unit' => fake()->numberBetween(1, 99999),
            'weight_per_unit' => fake()->numberBetween(1, 9999),
            'ean' => fake()->ean13(),
            'sku' => strtoupper(Str::random(8)),
        ];
    }
}
