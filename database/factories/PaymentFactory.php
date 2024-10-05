<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'transaction_id' => $this->faker->uuid(),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash']),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'status' => $this->faker->randomElement(['created', 'pending', 'paid', 'canceled']),
            'paid_at' => $this->faker->dateTimeThisYear(),
            'canceled_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
