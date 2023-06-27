<?php

namespace Idat\Centeno\Workshop\Objects\Reservations;


use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NewReservationData extends Data
{
    public function __construct(
        public int $customer_id,
        public int $vehicle_id,
        public int $service_id,
        public string $date_time,
        public string|Optional $currency,
        public float|Optional $price,
        public string|null $notes,
    ) {}
}
