<?php

namespace Database\Factories\Shop;

use App\Models\Shop\OrderAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderAddress>
 */
class OrderAddressFactory extends Factory
{
    protected $model = OrderAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => strtolower(fake()->countryCode()),
            'street' => fake()->streetAddress(),
            'state' => fake()->state(),
            'city' => fake()->city(),
            'zip' => fake()->postcode(),
        ];
    }
}
