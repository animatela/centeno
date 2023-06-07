<?php

namespace Database\Seeders;

use App\Models\Blog\Author;
use App\Models\Blog\Category as BlogCategory;
use App\Models\Blog\Post;
use App\Models\User;
use Closure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;

class DemoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->deletePublicStorage();

        // Admin
        $this->command->warn(PHP_EOL . 'Creating admin user...');

        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'centeno@arcnet.dev',
            'password' => bcrypt('password'),
        ]));

        $this->command->info('Admin user created.');

        // Blog
        $this->command->warn(PHP_EOL . 'Creating blog categories...');

        $blogCategories = $this->withProgressBar(
            20,
            fn () => BlogCategory::factory(1)->count(20)->create()
        );

        $this->command->info('Blog categories created.');

        $this->command->warn(PHP_EOL . 'Creating blog authors and posts...');

        $this->withProgressBar(20, fn () => Author::factory(1)
            ->has(
                Post::factory()->count(5)
                    //->has(
                    //    Comment::factory()->count(random_int(5, 10))
                    //        ->state(fn (array $attributes, Post $post) => ['customer_id' => $customers->random(1)->first()->id]),
                    //)
                    ->state(fn (array $attributes, Author $author) => ['blog_category_id' => $blogCategories->random(1)->first()->id]),
                'posts'
            )
            ->create());

        $this->command->info('Blog authors and posts created.');
    }

    protected function deletePublicStorage(): void
    {
        $files = Storage::files('public');

        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension !== 'gitignore' && ! str_starts_with($filename, '.')) {
                Storage::delete($file);
            }
        }
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $output = $this->command->getOutput();
        $progress = new ProgressBar($output, $amount);

        $progress->start();

        $items = new Collection();

        for ($i = 0; $i < $amount; $i++) {
            $items = $items->concat(
                $createCollectionOfOne()
            );
            $progress->advance();
        }

        $progress->finish();
        $output->writeln('');

        return $items;
    }
}
