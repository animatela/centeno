<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Blog\Author;
use App\Models\Blog\Category as BlogCategory;
use App\Models\Blog\Post;
use App\Models\Comment;
use App\Models\Shop\Brand;
use App\Models\Shop\Category as ShopCategory;
use App\Models\Shop\Customer as ShopCustomer;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Payment;
use App\Models\Shop\Product;
use App\Models\User;
use App\Models\Workshop\Customer as WorkshopCustomer;
use App\Models\Workshop\Maker;
use App\Models\Workshop\Service;
use App\Models\Workshop\ServiceItem;
use App\Models\Workshop\Vehicle;
use Closure;
use Exception;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
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
     * @throws Exception
     */
    public function run(): void
    {
        $this->deletePublicStorage();

        // Admin
        $this->command->warn(PHP_EOL.'Creating admin user...');

        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'centeno@arcnet.dev',
            'password' => bcrypt('password'),
        ]));

        $this->command->info('Admin user created.');

        // Workshop
        $makers = $this->seedWorkshopMakers(20);
        $customers = $this->seedWorkshopCustomers(100);
        $vehicles = $this->seedWorkshopVehicles(20, $makers, $customers);
        $services = $this->seedWorkshopServices(20);
        $reservations = $this->seedWorkshopReservations(100, $services, $vehicles);

        // Shop
        $brands = $this->seedShopBrands(20);
        $categories = $this->seedShopCategories(20);
        $customers = $this->seedShopCustomers(100);
        $products = $this->seedShopProducts(50, $brands, $categories, $customers);
        $this->seedShopOrders(100, $customers, $products);

        // Blog
        $blogCategories = $this->seedBlogCategories(20);
        $this->seedBlogAuthorsWithPosts(20, $customers, $blogCategories);
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

        $items = new Collection;

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

    protected function seedWorkshopMakers(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop makers...');

        $makers = $this->withProgressBar(
            $amount,
            fn () => Maker::factory()->count($amount)
                ->has(Address::factory()->count(random_int(1, 3)))
                ->create()
        );

        $this->command->info('Workshop makers created.');

        return $makers;
    }

    protected function seedWorkshopCustomers(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop customers...');

        $customers = $this->withProgressBar(
            $amount,
            fn () => WorkshopCustomer::factory(1)
                ->has(
                    Address::factory()->count(random_int(1, 3))
                )
                ->create()
        );

        $this->command->info('Workshop customers created.');

        return $customers;
    }

    protected function seedWorkshopVehicles(int $amount, Collection $makers, Collection $customers): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop vehicles...');

        $vehicles = $this->withProgressBar(
            $amount,
            fn () => Vehicle::factory(1)->sequence(
                fn ($sequence) => [
                    'workshop_maker_id' => $makers->random(1)->first()->id,
                    'workshop_customer_id' => $customers->random(1)->first()->id,
                ]
            )
        );

        $this->command->info('Workshop vehicles created.');

        return $vehicles;
    }

    private function seedWorkshopServices(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop services...');

        $orders = $this->withProgressBar($amount, fn () => Service::factory(1)
            ->has(ServiceItem::factory()->count(random_int(2, 5)), 'items')
            ->create()
        );

        $this->command->info('Workshop services created.');

        return $orders;
    }

    private function seedWorkshopReservations(int $amount, Collection $services, Collection $vehicles): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop reservations...');

        $reservations = $this->withProgressBar(
            $amount,
            fn () => Vehicle::factory(1)->sequence(
                fn ($sequence) => [
                    'workshop_service_id' => $services->random(1)->first()->id,
                    'workshop_vehicle_id' => $vehicles->random(1)->first()->id,
                ]
            )
        );

        $this->command->info('Workshop reservations created.');

        return $reservations;
    }

    private function seedShopBrands(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating shop brands...');

        $brands = $this->withProgressBar(
            $amount,
            fn () => Brand::factory()->count(20)
                ->has(Address::factory()->count(random_int(1, 3)))
                ->create()
        );

        $this->command->info('Shop brands created.');

        return $brands;
    }

    private function seedShopCategories(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating shop categories...');

        $categories = $this->withProgressBar(
            $amount,
            fn () => ShopCategory::factory(1)
                ->has(ShopCategory::factory()->count(3), 'children')
                ->create()
        );

        $this->command->info('Shop categories created.');

        return $categories;
    }

    private function seedShopCustomers(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating shop customers...');

        $customers = $this->withProgressBar(
            $amount,
            fn () => ShopCustomer::factory(1)
                ->has(Address::factory()->count(random_int(1, 3)))
                ->create()
        );

        $this->command->info('Shop customers created.');

        return $customers;
    }

    private function seedShopProducts(int $amount, Collection $brands, Collection $categories, Collection $customers): Collection
    {
        $this->command->warn(PHP_EOL.'Creating shop products...');

        $products = $this->withProgressBar(
            $amount,
            fn () => Product::factory(1)
                ->sequence(
                    fn ($sequence) => [
                        'shop_brand_id' => $brands->random(1)->first()->id,
                    ]
                )
                ->hasAttached(
                    $categories->random(random_int(3, 6)),
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                )
                ->has(
                    Comment::factory()->count(random_int(10, 20))
                        ->state(
                            fn (array $attributes, Product $product) => [
                                'customer_id' => $customers->random(1)->first()->id,
                            ]
                        ),
                )
                ->create()
        );

        $this->command->info('Shop products created.');

        return $products;
    }

    /**
     * @param  int  $amount
     * @param  Collection  $customers
     * @param  Collection  $products
     * @return void
     * @throws Exception
     */
    private function seedShopOrders(int $amount, Collection $customers, Collection $products): void
    {
        $this->command->warn(PHP_EOL.'Creating orders...');

        $orders = $this->withProgressBar($amount, fn () => Order::factory(1)
            ->sequence(
                fn ($sequence) => [
                    'shop_customer_id' => $customers->random(1)->first()->id,
                ]
            )
            ->has(Payment::factory()->count(random_int(1, 3)))
            ->has(
                OrderItem::factory()->count(random_int(2, 5))
                    ->state(
                        fn (array $attributes, Order $order) => [
                            'shop_product_id' => $products->random(1)->first()->id,
                        ]
                    ),
                'items'
            )
            ->create());

        /*foreach ($orders->random(random_int(5, 8)) as $order) {
            Notification::make()
                ->title('New order')
                ->icon('heroicon-o-shopping-bag')
                ->body("**{$order->customer->name} ordered {$order->items->count()} products.**")
                ->actions([
                    Action::make('View')
                        ->url(OrderResource::getUrl('edit', ['record' => $order])),
                ])
                ->sendToDatabase($user);
        }*/

        $this->command->info('Shop orders created.');
    }

    private function seedBlogCategories(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating blog categories...');

        $blogCategories = $this->withProgressBar(
            $amount,
            fn () => BlogCategory::factory(1)->count(20)->create()
        );

        $this->command->info('Blog categories created.');

        return $blogCategories;
    }

    private function seedBlogAuthorsWithPosts(int $amount, Collection $customers, Collection $blogCategories): void
    {
        $this->command->warn(PHP_EOL.'Creating blog authors and posts...');

        $this->withProgressBar(
            $amount, fn () => Author::factory(1)
            ->has(
                Post::factory()->count(5)
                    ->has(
                        Comment::factory()->count(random_int(5, 10))->state(
                            fn (array $attributes, Post $post) => [
                                'customer_id' => $customers->random(1)->first()->id,
                            ]
                        ),
                    )
                    ->state(
                        fn (array $attributes, Author $author) => [
                            'blog_category_id' => $blogCategories->random(1)->first()->id,
                        ]
                    ),
                'posts'
            )
            ->create()
        );

        $this->command->info('Blog authors and posts created.');
    }
}
