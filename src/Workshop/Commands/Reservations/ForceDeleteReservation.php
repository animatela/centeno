<?php

namespace Idat\Centeno\Workshop\Commands\Reservations;

use App\Models\Workshop\Reservation;
use Illuminate\Support\Facades\DB;

class ForceDeleteReservation
{
    public function handle(int $id): int
    {
        return DB::transaction(
            callback: static fn () => Reservation::whereId($id)->forceDelete(),
            attempts: 2,
        );
    }
}
