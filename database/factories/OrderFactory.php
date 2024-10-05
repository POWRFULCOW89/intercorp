<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'paid', 'shipped', 'delivered', 'canceled']),
            'notes' => $this->faker->text(),
            'delivered_at' => $this->faker->dateTimeThisYear(),
            'canceled_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
