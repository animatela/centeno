<?php

namespace Database\Seeders\Dummy;

use App\Models\Workshop\Customer;
use App\Models\Workshop\Reservation;
use App\Models\Workshop\Service;
use App\Support\Traits\WithProgressBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DummyReservationSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating workshop reservations...');

        $customers = Customer::all();
        $services = Service::all();

        $this->withProgressBar(
            40,
            fn () => $this->createReservation($customers, $services)
        );

        $this->command->info('Workshop reservations created.');
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
