<?php

namespace Idat\Centeno\Workshop\Commands\Vehicles;

use App\Models\Workshop\Vehicle;
use Illuminate\Database\Eloquent\Model;

final class FindVehicle
{
    public function handle(int $id): Model|Vehicle
    {
        return Vehicle::query()->find($id);
    }
}
