<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLine>
 */
class OrderLineFactory extends Factory
{
    public function definition()
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $quantity = $this->faker->numberBetween(1, 10);

        return [
            'order_id' => Order::factory(),
            'name' => $product->name,
            'amount' => $quantity,
            'price_per_unit' => $product->price_per_unit,
        ];
    }
}
