<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = fake()->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            'sku' => fake()->unique()->ean8(),
            'barcode' => fake()->ean13(),
            'description' => fake()->realText(),
            'qty' => fake()->randomDigitNotNull(),
            'security_stock' => fake()->randomDigitNotNull(),
            'featured' => fake()->boolean(),
            'is_visible' => fake()->boolean(),
            'old_price' => fake()->randomFloat(2, 100, 500),
            'price' => fake()->randomFloat(2, 80, 400),
            'cost' => fake()->randomFloat(2, 50, 200),
            'type' => fake()->randomElement(['deliverable', 'downloadable']),
            'published_at' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'created_at' => fake()->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }

    /**
     * Configure the factory.
     */
    public function configure(): ProductFactory
    {
        return $this->afterCreating(function (Product $product) {
            try {
                $product
                    ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
                    ->toMediaCollection('product-images');
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
