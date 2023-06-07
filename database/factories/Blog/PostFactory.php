<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->unique()->sentence(4),
            'slug' => Str::slug($title),
            'content' => fake()->realText(),
            'image' => $this->createImage(),
            'published_at' => fake()->dateTimeBetween('-6 month', '+1 month'),
            'created_at' => fake()->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function createImage(): ?string
    {
        try {
            $image = file_get_contents(DatabaseSeeder::IMAGE_URL);
        } catch (Throwable) {
            return null;
        }

        $filename = Str::uuid().'.jpg';

        Storage::disk('public')->put($filename, $image);

        return $filename;
    }
}
