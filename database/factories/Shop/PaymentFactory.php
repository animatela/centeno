<?php

namespace Database\Factories\Shop;

use Akaunting\Money\Currency;
use App\Models\Shop\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => 'PAY'.fake()->unique()->randomNumber(6),
            'currency' => fake()->randomElement(collect(Currency::getCurrencies())->keys()),
            'amount' => fake()->randomFloat(2, 100, 2000),
            'provider' => fake()->randomElement(['stripe', 'paypal']),
            'method' => fake()->randomElement(['credit_card', 'bank_transfer', 'paypal']),
            'created_at' => fake()->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
