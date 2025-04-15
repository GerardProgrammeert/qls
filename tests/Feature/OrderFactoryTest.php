<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\ContactTypeEnum;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderFactoryTest extends TestCase
{
    use RefreshDatabase;

    #[test]
    public function it_creates_an_order_with_contacts_and_order_lines()
    {
        /** @var Order $order */
        $order = Order::factory()->create();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
        ]);
        $this->assertDatabaseCount('orders', 1);
        $this->assertCount(2, $order->contacts);
        $this->assertGreaterThan(2, $order->orderLines->count());
        $this->assertDatabaseHas('contacts', [
            'contactable_id' => $order->id,
            'contactable_type' => Order::class,
            'type' => ContactTypeEnum::DELIVERY,
        ]);
        $this->assertDatabaseHas('contacts', [
            'contactable_id' => $order->id,
            'contactable_type' => Order::class,
            'type' => ContactTypeEnum::RECEIVER,
        ]);
    }
}
