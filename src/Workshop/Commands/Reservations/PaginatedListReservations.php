<?php

namespace Idat\Centeno\Workshop\Commands\Reservations;

use App\Models\Workshop\Reservation;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Facades\DB;

final class PaginatedListReservations
{
    public function handle(?int $customerId): CursorPaginator
    {
        $query = Reservation::query();

        if ($customerId) {
            $query->where('customer_id', $customerId);
        }

        return DB::transaction(
            callback: static fn () => $query->cursorPaginate(),
            attempts: 2
        );
    }
}
