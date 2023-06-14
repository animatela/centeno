<?php

namespace Idat\Centeno\Workshop\Objects\Reservations;

use Idat\Centeno\Workshop\Enums\FuelType;
use Idat\Centeno\Workshop\Enums\ReservationStatus;
use Idat\Centeno\Workshop\Enums\TransmissionType;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NewReservationData extends Data
{
    public function __construct(
        public int $customer_id,
        public int $vehicle_id,
        public int $service_id,
        public string $number,
        public string $currency,
        public Carbon $date_time,
        public float $price,
        public ReservationStatus $status,
        public Carbon|Optional|null $created_at,
        public Carbon|Optional|null $updated_at,
        public Carbon|Optional|null $deleted_at,
    ) {}
}
