<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class ListVehicles
{
    public function handle(?int $customerId): Collection
    {
        $query = Vehicle::query();

        if ($customerId) {
            $query->where('workshop_customer_id', $customerId);
        }

        return DB::transaction(
            callback: static fn () => $query->get(),
            attempts: 2
        );
    }
}
