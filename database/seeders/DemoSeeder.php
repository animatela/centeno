<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Blog\Author as BlogAuthor;
use App\Models\Blog\Category as BlogCategory;
use App\Models\Blog\Post as BlogPost;
use App\Models\Comment;
use App\Models\Shop\Brand as ShopBrand;
use App\Models\Shop\Category as ShopCategory;
use App\Models\Shop\Customer as ShopCustomer;
use App\Models\Shop\Order as ShopOrder;
use App\Models\Shop\OrderItem as ShopOrderItem;
use App\Models\Shop\Payment as ShopPayment;
use App\Models\Shop\Product as ShopProduct;
use App\Models\User;
use App\Models\Workshop\Customer as WorkshopCustomer;
use App\Models\Workshop\Maker as WorkshopMaker;
use App\Models\Workshop\Reservation as WorkshopReservation;
use App\Models\Workshop\Service as WorkshopService;
use App\Models\Workshop\ServiceItem as WorkshopServiceItem;
use App\Models\Workshop\Vehicle as WorkshopVehicle;
use App\Support\PurgeStorageService;
use App\Support\Traits\WithProgressBar;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        PurgeStorageService::purge('public');

        // Admin
        $admin = $this->seedAdmin();

        // Workshop
        $workshopUsers = $this->seedUsersForWorkshopCustomers(10);
        $workshopCustomers = $this->seedWorkshopCustomers(10, $workshopUsers);
        $workshopVehicles = $this->seedWorkshopVehicles(20, $workshopCustomers);
        $workshopServices = $this->seedWorkshopServices(20);
        $this->seedWorkshopReservations(100, $workshopServices, $workshopVehicles);

        // Shop
        //$shopBrands = $this->seedShopBrands(20);
        //$shopCategories = $this->seedShopCategories(20);
        //$shopCustomers = $this->seedShopCustomers(10);
        //$shopProducts = $this->seedShopProducts(10, $shopBrands, $shopCategories, $shopCustomers);
        //$this->seedShopOrders(100, $shopCustomers, $shopProducts);

        // Blog
        //$blogCategories = $this->seedBlogCategories(20);
        //$this->seedBlogAuthorsWithPosts(20, $shopCustomers, $blogCategories);
    }

    protected function seedAdmin(): Collection
    {
        $this->command->warn(PHP_EOL.'Creating admin user...');

        $admins = $this->withProgressBar(
            1,
            fn () => User::factory(1)->create([
                'name' => 'Admin',
                'email' => 'centeno@arcnet.dev',
                'password' => bcrypt('password'),
            ])
        );

        $this->command->info('Admin user created.');

        return $admins;
    }

    protected function seedUsersForWorkshopCustomers(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating users...');

        $users = $this->withProgressBar(
            $amount,
            fn () => User::factory(1)->create([
                'password' => bcrypt('password'),
            ])
        );

        $this->command->info('Users created.');

        return $users->reverse();
    }

    protected function seedWorkshopMakers(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop makers...');

        $makers = $this->withProgressBar(
            $amount,
            fn () => WorkshopMaker::factory()->count($amount)
                ->has(Address::factory()->count(1))
                ->create()
        );

        $this->command->info('Workshop makers created.');

        return $makers;
    }

    protected function seedWorkshopCustomers(int $amount, Collection $users): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop customers...');

        $customers = $this->withProgressBar(
            $amount,
            fn () => WorkshopCustomer::factory(1)
                ->for($users->pop())
                ->has(Address::factory()->count(1))
                ->create()
        );

        $this->command->info('Workshop customers created.');

        return $customers;
    }

    protected function seedWorkshopVehicles(int $amount, Collection $customers): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop vehicles...');

        $vehicles = $this->withProgressBar(
            $amount,
            fn () => WorkshopVehicle::factory(1)
                ->for($customers->random(1)->first())
                ->create()
        );

        $this->command->info('Workshop vehicles created.');

        return $vehicles;
    }

    private function seedWorkshopServices(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop services...');

        $services = $this->withProgressBar(
            $amount,
            fn () => WorkshopService::factory(1)
                ->has(WorkshopServiceItem::factory()->count(2), 'items')
                ->create()
        );

        $this->command->info('Workshop services created.');

        return $services;
    }

    private function seedWorkshopReservations(int $amount, Collection $services, Collection $vehicles): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop reservations...');

        $reservations = $this->withProgressBar(
            $amount,
            fn () => WorkshopReservation::factory(1)
                ->for($services->random(1)->first())
                ->for($vehicles->random(1)->first())
                ->create()
        );

        $this->command->info('Workshop reservations created.');

        return $reservations;
    }

    private function seedShopBrands(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating shop brands...');

        $brands = $this->withProgressBar(
            $amount,
            fn () => ShopBrand::factory()->count(20)
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
            fn () => ShopProduct::factory(1)
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
                            fn (array $attributes, ShopProduct $product) => [
                                'customer_id' => $customers->random(1)->first()->id,
                            ]
                        ),
                )
                ->create()
        );

        $this->command->info('Shop products created.');

        return $products;
    }

    private function seedShopOrders(int $amount, Collection $customers, Collection $products): void
    {
        $this->command->warn(PHP_EOL.'Creating orders...');

        $orders = $this->withProgressBar($amount, fn () => ShopOrder::factory(1)
            ->sequence(
                fn ($sequence) => [
                    'shop_customer_id' => $customers->random(1)->first()->id,
                ]
            )
            ->has(ShopPayment::factory()->count(random_int(1, 3)))
            ->has(
                ShopOrderItem::factory()->count(random_int(2, 5))
                    ->state(
                        fn (array $attributes, ShopOrder $order) => [
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

    private function seedBlogAuthorsWithPosts(int $amount, Collection $customers, Collection $categories): void
    {
        $this->command->warn(PHP_EOL.'Creating blog authors and posts...');

        $this->withProgressBar(
            $amount, fn () => BlogAuthor::factory(1)
            ->has(
                BlogPost::factory()->count(5)
                    ->has(
                        Comment::factory()->count(random_int(5, 10))->state(
                            fn (array $attributes, BlogPost $post) => [
                                'customer_id' => $customers->random(1)->first()->id,
                            ]
                        ),
                    )
                    ->state(
                        fn (array $attributes, BlogAuthor $author) => [
                            'blog_category_id' => $categories->random(1)->first()->id,
                        ]
                    ),
                'posts'
            )
            ->create()
        );

        $this->command->info('Blog authors and posts created.');
    }
}
