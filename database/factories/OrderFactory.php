<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'shipment_id' => fake()->uuid(),
            'country' => 'NL',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
                Contact::factory()
                    ->delivery()
                    ->forOrder($order)
                    ->create();

                Contact::factory()
                    ->receiver()
                    ->forOrder($order)
                    ->create();

                OrderLine::factory()
                    ->count(rand(2, 8))
                    ->create(['order_id' => $order->id]);
        });
    }
}
