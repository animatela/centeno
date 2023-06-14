<?php

namespace Idat\Centeno\Workshop\Commands\Reservations;

use App\Models\Workshop\Reservation;
use Idat\Centeno\Workshop\Objects\Reservations\NewReservationData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateNewReservation
{
    public function handle(NewReservationData $newReservation): Model|Reservation
    {
        return DB::transaction(
            callback: static fn () => Reservation::query()->create($newReservation->toArray()),
            attempts: 2,
        );
    }
}
