<?php

namespace Idat\Centeno\Workshop\Commands\Reservations;

use App\Models\Workshop\Reservation;
use Illuminate\Database\Eloquent\Model;

final class FindReservation
{
    public function handle(int $id): Model|Reservation
    {
        return Reservation::query()->find($id);
    }
}
