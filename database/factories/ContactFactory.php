<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ContactTypeEnum;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * @return array<string, string|integer>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'companyname' => $this->faker->company,
            'street' => $this->faker->streetName,
            'housenumber' => $this->faker->buildingNumber,
            'address2' => $this->faker->optional()->secondaryAddress,
            'postalcode' => $this->faker->postcode,
            'locality' => $this->faker->city,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'type' => $this->faker->randomElement(ContactTypeEnum::cases()),
            'country' => 'NL',
            'order_id' => Order::factory(),
        ];
    }

    public function forOrder(Order $order): Factory
    {
        return $this->state(function () use ($order) {
            return [
                'order_id' => $order->id,
            ];
        });
    }

    public function delivery(): Factory
    {
        return $this->state([
            'type' => ContactTypeEnum::DELIVERY,
        ]);
    }
    public function receiver(): Factory
    {
        return $this->state([
            'type' => ContactTypeEnum::RECEIVER,
        ]);
    }
}
