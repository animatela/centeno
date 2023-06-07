<?php

namespace Database\Factories\Workshop;

use App\Models\Workshop\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'birthday' => fake()->dateTimeBetween('-35 years', '-18 years'),
            'gender' => fake()->randomElement(['male', 'female']),
            'document_type' => fake()->randomElement(['dni', 'ce', 'ruc']),
            'document_number' => Str::padLeft(fake()->numberBetween(10000000, 99999999999), 11, 0),
            'created_at' => fake()->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
