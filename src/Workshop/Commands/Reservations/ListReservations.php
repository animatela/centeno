<?php

namespace Idat\Centeno\Workshop\Commands\Reservations;

use App\Models\Workshop\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class ListReservations
{
    public function handle(?int $customerId): Collection
    {
        $query = Reservation::query();

        if ($customerId) {
            $query->where('customer_id', $customerId);
        }

        return DB::transaction(
            callback: static fn () => $query->get(),
            attempts: 2
        );
    }
}
