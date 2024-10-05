<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tracking_number' => $this->faker->uuid(),
            'order_id' => Order::factory(),
            'status' => $this->faker->randomElement(['created', 'documented', 'traveling', 'drop_off', 'delivered', 'return']),
        ];
    }
}
