<?php

namespace Idat\Centeno\Workshop\Objects\Vehicles;

use Idat\Centeno\Workshop\Enums\FuelType;
use Idat\Centeno\Workshop\Enums\TransmissionType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NewVehicleData extends Data
{
    public function __construct(
        public int $customer_id,
        public string $name,
        public string|Optional|null $body_type,
        public string|Optional|null $maker,
        public string|Optional|null $model,
        public string|Optional|null $color,
        public string|Optional|null $year,
        public FuelType|Optional|null $fuel_type,
        public TransmissionType|Optional|null $transmission_type,
        public string|Optional|null $plate,
        public int|Optional|null $mileage,
    ) {}
}
