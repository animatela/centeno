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
            'number' => Str::upper(Str::of(Str::ulid()->toRfc4122())->explode('-')->last()),
            'currency' => fake()->randomElement(['PEN', 'USD']),
            'reservation_date' => fake()->date('Y-m-d', '+10 days'),
            'reservation_time' => fake()->time('H:i:s', '+10 days'),
            'price' => fake()->randomFloat(2, 100, 2000),
            'status' => fake()->randomElement(['new', 'started', 'processing', 'completed', 'cancelled']),
            'notes' => fake()->realText(100),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
