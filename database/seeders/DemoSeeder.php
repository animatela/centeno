<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Workshop\Customer;
use App\Models\Workshop\Reservation;
use App\Models\Workshop\Service;
use App\Models\Workshop\ServiceItem;
use App\Models\Workshop\Vehicle;
use App\Support\PurgeStorageService;
use App\Support\Traits\WithProgressBar;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $this->seedAdmin();

        // Workshop
        $workshopUsers = $this->seedWorkshopUsers(5);
        $workshopServices = $this->seedWorkshopServices(2);
        $workshopCustomers = $this->seedWorkshopCustomers(5, $workshopUsers);
        $this->seedWorkshopVehicles(10, $workshopCustomers);
        $this->seedWorkshopReservations(100, $workshopServices, $workshopCustomers);
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

    protected function seedWorkshopUsers(int $amount): Collection
    {
        $this->command->warn(PHP_EOL.'Creating users...');

        $emails = collect(range(1, 10))->mapWithKeys(
            fn ($number) => [$number => 'customer_'.Str::padLeft($number, 2, 0).'@example.com']
        )->reverse();

        $users = $this->withProgressBar(
            $amount,
            fn () => User::factory(1)->create([
                'email' => $emails->pop(),
                'password' => bcrypt('password'),
            ])
        );

        $this->command->info('Users created.');

        return $users->reverse();
    }

    protected function seedWorkshopCustomers(int $amount, Collection $users): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop customers...');

        $customers = $this->withProgressBar(
            $amount,
            fn () => Customer::factory(1)
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
            fn () => Vehicle::factory(1)
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
            fn () => Service::factory(1)
                ->has(ServiceItem::factory()->count(5), 'items')
                ->create()
        );

        $this->command->info('Workshop services created.');

        return $services;
    }

    private function seedWorkshopReservations(int $amount, Collection $services, Collection $customers): Collection
    {
        $this->command->warn(PHP_EOL.'Creating workshop reservations...');

        $reservations = $this->withProgressBar(
            $amount,
            fn () => $this->createReservation($customers, $services)
        );

        $this->command->info('Workshop reservations created.');

        return $reservations;
    }

    private static function createReservation(Collection $customers, Collection $services)
    {
        $customer = $customers->random(1)->first();

        return Reservation::factory(1)
            ->for($customer)
            ->for($customer->vehicles->random(1)->first())
            ->for($services->random(1)->first())
            ->create();
    }
}
