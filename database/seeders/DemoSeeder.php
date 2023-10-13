<?php

namespace Database\Seeders;

use App\Support\PurgeStorageService;
use App\Support\Traits\WithProgressBar;
use Database\Seeders\Dummy\DummyAdminSeeder;
use Database\Seeders\Dummy\DummyCustomerSeeder;
use Database\Seeders\Dummy\DummyCustomerVehicleSeeder;
use Database\Seeders\Dummy\DummyOrderSeeder;
use Database\Seeders\Dummy\DummyProductSeeder;
use Database\Seeders\Dummy\DummyPublicUserSeeder;
use Database\Seeders\Dummy\DummyReservationSeeder;
use Database\Seeders\Dummy\DummyServiceItemSeeder;
use Database\Seeders\Dummy\DummyServiceSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurgeStorageService::purge('public');

        $this->call([
            DummyAdminSeeder::class,
            DummyPublicUserSeeder::class,
            DummyCustomerSeeder::class,
            DummyCustomerVehicleSeeder::class,
            DummyServiceSeeder::class,
            DummyServiceItemSeeder::class,
            DummyReservationSeeder::class,
            DummyProductSeeder::class,
            DummyOrderSeeder::class,
        ]);
    }
}
