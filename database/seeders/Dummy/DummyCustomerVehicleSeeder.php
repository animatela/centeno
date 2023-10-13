<?php

namespace Database\Seeders\Dummy;

use App\Models\Workshop\Customer;
use App\Models\Workshop\Vehicle;
use App\Support\Traits\WithProgressBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyCustomerVehicleSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating workshop vehicles...');

        $customers = Customer::all();

        $vehicles = $this->withProgressBar(
            10,
            fn () => Vehicle::factory(3)
                ->for($customers->random(1)->first())
                ->create()
        );

        $this->command->info('Workshop vehicles created.');
    }
}
