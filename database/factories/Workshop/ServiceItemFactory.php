<?php

namespace Database\Factories\Workshop;

use App\Models\Workshop\ServiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceItem>
 */
class ServiceItemFactory extends Factory
{
    protected $model = ServiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'currency' => fake()->randomElement(['PEN', 'USD']),
            'qty' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(2, 100, 500),
        ];
    }
}
