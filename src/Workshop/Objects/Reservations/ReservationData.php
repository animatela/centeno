<?php

namespace Idat\Centeno\Workshop\Objects\Reservations;

use Idat\Centeno\Workshop\Enums\Currency;
use Idat\Centeno\Workshop\Enums\ReservationStatus;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ReservationData extends Data
{
    public function __construct(
        public int $id,
        public int $customer_id,
        public int $vehicle_id,
        public int $service_id,
        public string $number,
        public Currency|Optional|null $currency,
        public Carbon|Optional|null $date_time,
        public float|Optional|null $price,
        public ReservationStatus $status,
        public string|Optional|null $notes,
        public Carbon|Optional|null $created_at,
        public Carbon|Optional|null $updated_at,
        public Carbon|Optional|null $deleted_at,
    ) {}
}
