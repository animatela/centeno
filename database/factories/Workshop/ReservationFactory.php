<?php

namespace Database\Factories\Workshop;

use App\Models\Workshop\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => 'RE'.Str::padLeft(fake()->unique()->randomNumber(6), 10, 0),
            'currency' => fake()->randomElement(['PEN', 'USD']),
            'date_time' => fake()->dateTimeBetween('now', '+10 days'),
            'price' => fake()->randomFloat(2, 100, 2000),
            'status' => fake()->randomElement(['new', 'started', 'processing', 'completed', 'cancelled']),
            'notes' => fake()->realText(100),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
