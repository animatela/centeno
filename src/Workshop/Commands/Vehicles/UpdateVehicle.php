<?php

namespace Idat\Centeno\Workshop\Commands\Vehicles;

use App\Models\Workshop\Vehicle;
use Idat\Centeno\Workshop\Objects\Vehicles\UpdatedVehicleData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class UpdateVehicle
{
    public function handle(int $id, UpdatedVehicleData $vehicle): int
    {
        return DB::transaction(
            callback: static fn () => Vehicle::whereId($id)->update($vehicle->toArray()),
            attempts: 2,
        );
    }
}
