<?php

namespace Idat\Centeno\Workshop\Objects\Reservations;

use Idat\Centeno\Workshop\Enums\FuelType;
use Idat\Centeno\Workshop\Enums\ReservationStatus;
use Idat\Centeno\Workshop\Enums\TransmissionType;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdatedReservationData extends Data
{
    public function __construct(
        public int $service_id,
        public string $reservation_date,
        public string $reservation_time,
        public string|Optional $currency,
        public float|Optional $price,
        public ReservationStatus|Optional $status,
        public string|Optional|null $notes,
        public Carbon|Optional|null $created_at,
        public Carbon|Optional|null $updated_at,
        public Carbon|Optional|null $deleted_at,
    ) {}
}
