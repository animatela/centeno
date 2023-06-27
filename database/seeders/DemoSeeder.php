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
use Idat\Centeno\Workshop\Objects\Services\NewServiceData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Collection;
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
        $this->seedWorkshopServiceItems($workshopServices);
        $this->seedWorkshopVehicles(10, $workshopCustomers);
        $this->seedWorkshopReservations(40, $workshopServices, $workshopCustomers);
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
            fn () => Vehicle::factory(2)
                ->for($customers->random(1)->first())
                ->create()
        );

        $this->command->info('Workshop vehicles created.');

        return $vehicles;
    }

    private function seedWorkshopServices(): Collection
    {
        $initialData = [
            NewServiceData::from([
                'name' => 'Mantenimiento Preventivo',
                'slug' => 'services/mantenimiento-preventivo',
                'description' => 'Se realiza con el fin de prevenir o evitar fallas en el vehículo, mediante la revisión y cambio de piezas.',
            ]),
            NewServiceData::from([
                'name' => 'Mantenimiento Correctivo',
                'slug' => 'services/mantenimiento-correctivo',
                'description' => 'Se realiza cuando el vehículo presenta alguna falla o avería, con el fin de repararla y que el vehículo vuelva a funcionar correctamente.',
            ]),
        ];

        $this->command->warn(PHP_EOL.'Creating workshop services...');

        $services = collect($initialData)->map(
            fn (NewServiceData $service) => Service::factory()->create(
                $service->toArray()
            )
        );

        $this->command->info('Workshop services created.');

        return $services;
    }

    private function seedWorkshopServiceItems(Collection $services): void
    {
        $initialData = [
            1 => [
                [
                    'description' => 'Cambio de aceite de motor',
                    'quantity' => 1,
                    'price' => 100,
                ],
                [
                    'description' => 'Cambio de filtro de aceite de motor',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Cambio de filtro de aire de motor',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Cambio de filtro de combustible de motor',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Cambio de filtro de habitáculo de motor',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Cambio de bujías de motor',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Cambio de pastillas de freno',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Cambio de discos de freno',
                    'quantity' => 1,
                    'price' => 50,
                ],
            ],
            2 => [
                [
                    'description' => 'Reparación de componentes defectuosos',
                    'quantity' => 1,
                    'price' => 100,
                ],
                [
                    'description' => 'Solución de problemas eléctricos',
                    'quantity' => 1,
                    'price' => 150,
                ],
                [
                    'description' => 'Reparación de fugas de líquidos',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Solución de problemas de rendimiento',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Reparación de daños por accidentes',
                    'quantity' => 1,
                    'price' => 50,
                ],
                [
                    'description' => 'Reparación de daños por desgaste',
                    'quantity' => 1,
                    'price' => 50,
                ],
            ],
        ];

        $this->command->warn(PHP_EOL.'Creating workshop service items...');

        collect($initialData)->each(
            fn (array $items, int $serviceId) => collect($items)->each(
                fn (array $item) => ServiceItem::factory()->create(
                    array_merge(
                        $item,
                        [
                            'service_id' => $serviceId,
                        ]
                    )
                )
            )
        );

        $this->command->info('Workshop service items created.');
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
