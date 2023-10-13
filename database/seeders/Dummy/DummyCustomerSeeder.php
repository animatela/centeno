<?php

namespace Database\Seeders\Dummy;

use App\Models\Address;
use App\Models\User;
use App\Models\Workshop\Customer;
use App\Models\Workshop\Vehicle;
use App\Support\Traits\WithProgressBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DummyCustomerSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating workshop customers...');

        $users = $this->fetchAvailableUsers();

        $this->withProgressBar(
            $users->count(),
            fn () => Customer::factory(1)
                ->for($users->pop())
                ->has(Address::factory()->count(1))
                ->has(Vehicle::factory()->count(4))
                ->create()
        );

        $this->command->info('Workshop customers created.');
    }

    private function fetchAvailableUsers(): Collection
    {
        return User::all()->filter(
            fn ($user) => str_ends_with($user->email, '@example.com')
        )->values();
    }
}
