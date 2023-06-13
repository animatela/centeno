<?php

namespace Idat\Centeno\Workshop\Commands\Vehicles;

use App\Models\Workshop\Vehicle;
use Idat\Centeno\Workshop\Objects\Vehicles\NewVehicleData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateNewVehicle
{
    public function handle(NewVehicleData $newVehicle): Model|Vehicle
    {
        return DB::transaction(
            callback: static fn () => Vehicle::query()->create($newVehicle->toArray()),
            attempts: 2,
        );
    }
}
