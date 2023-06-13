<?php

namespace Idat\Centeno\Workshop\Commands\Vehicles;

use App\Models\Workshop\Customer;
use App\Models\Workshop\Vehicle;
use Illuminate\Support\Facades\DB;

class DeleteVehicle
{
    public function handle(int $id): int
    {
        return DB::transaction(
            callback: static fn () => Vehicle::whereId($id)->delete(),
            attempts: 2,
        );
    }
}
