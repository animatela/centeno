<?php

namespace Idat\Centeno\Workshop\Services;

use Idat\Centeno\Workshop\Commands\Services\ListVehicles;
use Illuminate\Database\Eloquent\Collection;

final class VehicleService
{
    public function __construct(
        private readonly ListVehicles $listVehicles,
    ) {}

    public function list(?int $customerId): Collection
    {
        return $this->listVehicles->handle(
            $customerId
        );
    }
}
