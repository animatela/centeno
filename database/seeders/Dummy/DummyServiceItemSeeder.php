<?php

namespace Database\Seeders\Dummy;

use App\Models\Workshop\ServiceItem;
use App\Support\Traits\WithProgressBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyServiceItemSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating workshop service items...');

        $initialData = $this->fakeServiceItems();

        collect($initialData)->each(
            fn (array $items, int $serviceId) => collect($items)->each(
                fn (array $item) => ServiceItem::factory()->create(
                    array_merge($item, [
                        'service_id' => $serviceId,
                    ])
                )
            )
        );

        $this->command->info('Workshop service items created.');
    }

    private function fakeServiceItems(): array
    {
        return [
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
    }
}
