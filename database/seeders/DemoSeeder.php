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
                ->has(ServiceItem::factory()->count(2), 'items')
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
            fn () => Reservation::factory(1)
                ->for($services->random(1)->first())
                ->for($vehicles->random(1)->first())
                ->create()
        );

        $this->command->info('Workshop reservations created.');

        return $reservations;
    }
}
