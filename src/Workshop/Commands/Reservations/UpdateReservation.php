<?php

namespace Idat\Centeno\Workshop\Commands\Reservations;

use App\Models\Workshop\Reservation;
use Idat\Centeno\Workshop\Objects\Reservations\UpdatedReservationData;
use Illuminate\Support\Facades\DB;

final class UpdateReservation
{
    public function handle(int $id, UpdatedReservationData $reservation): int
    {
        return DB::transaction(
            callback: static fn () => Reservation::whereId($id)->update($reservation->toArray()),
            attempts: 2,
        );
    }
}
