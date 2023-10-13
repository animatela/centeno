<?php

namespace Database\Seeders\Dummy;

use App\Models\Workshop\Service;
use App\Support\Traits\WithProgressBar;
use Idat\Centeno\Workshop\Objects\Services\NewServiceData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyServiceSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = $this->fakeServices();

        $this->command->warn(PHP_EOL.'Creating workshop services...');

        collect($initialData)->map(
            fn (NewServiceData $service) => Service::factory()->create(
                $service->toArray()
            )
        );

        $this->command->info('Workshop services created.');
    }

    /**
     * @return array
     */
    private function fakeServices(): array
    {
        return [
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
    }
}
