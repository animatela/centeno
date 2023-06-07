<?php

namespace Database\Factories\Shop;

use App\Models\Shop\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'qty' => fake()->numberBetween(1, 10),
            'unit_price' => fake()->randomFloat(2, 100, 500),
        ];
    }
}
