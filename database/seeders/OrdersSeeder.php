<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()->count(20)->create();
    }
}
