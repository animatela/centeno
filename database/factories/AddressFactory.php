<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

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
