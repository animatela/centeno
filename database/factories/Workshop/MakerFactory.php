<?php

namespace Database\Factories\Workshop;

use App\Models\Workshop\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Maker>
 */
class MakerFactory extends Factory
{
    protected $model = Maker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = fake()->unique()->company(),
            'slug' => Str::slug($name),
            'website' => 'https://www.'.fake()->domainName(),
            'description' => fake()->realText(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->e164PhoneNumber(),
            'is_visible' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
