<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => 'OR'.fake()->unique()->randomNumber(6),
            'currency' => strtolower(fake()->currencyCode()),
            'total_price' => fake()->randomFloat(2, 100, 2000),
            'status' => fake()->randomElement(['new', 'processing', 'shipped', 'delivered', 'cancelled']),
            'shipping_price' => fake()->randomFloat(2, 100, 500),
            'shipping_method' => fake()->randomElement(['free', 'flat', 'flat_rate', 'flat_rate_per_item']),
            'notes' => fake()->realText(100),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }

    /**
     * Configure the factory.
     */
    public function configure(): Factory
    {
        return $this->afterCreating(function (Order $order) {
            $order->address()->save(OrderAddressFactory::new()->make());
        });
    }
}
