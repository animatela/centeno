<?php

namespace Database\Factories\Workshop;

use App\Models\Workshop\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'type' => fake()->unique()->word(),
            'model' => fake()->unique()->word(),
            'year' => fake()->year(),
            'color' => fake()->colorName(),
            'plate' => fake()->regexify('[A-Z0-9]{3}-[0-9]{3}'),
            'mileage' => fake()->randomNumber(8),
            'is_visible' => fake()->boolean(),
        ];
    }
}
