<?php

namespace Idat\Centeno\Workshop\Repositories;

use Idat\Centeno\Workshop\Commands\Vehicles\CreateNewVehicle;
use Idat\Centeno\Workshop\Commands\Vehicles\DeleteVehicle;
use Idat\Centeno\Workshop\Commands\Vehicles\FindVehicle;
use Idat\Centeno\Workshop\Commands\Vehicles\ForceDeleteVehicle;
use Idat\Centeno\Workshop\Commands\Vehicles\ListVehicles;
use Idat\Centeno\Workshop\Commands\Vehicles\UpdateVehicle;
use Idat\Centeno\Workshop\Objects\Vehicles\NewVehicleData;
use Idat\Centeno\Workshop\Objects\Vehicles\UpdatedVehicleData;
use Idat\Centeno\Workshop\Objects\Vehicles\VehicleData;
use Illuminate\Database\Eloquent\Collection;

final class VehicleRepository
{
    public function __construct(
        private readonly ListVehicles $listVehicles,
        private readonly CreateNewVehicle $createVehicle,
        private readonly FindVehicle $findVehicle,
        private readonly UpdateVehicle $updateVehicle,
        private readonly DeleteVehicle $deleteVehicle,
        private readonly ForceDeleteVehicle $forceDeleteVehicle,
    ) {}

    public function list(?int $customerId): Collection
    {
        return $this->listVehicles->handle(
            $customerId
        );
    }

    public function create(array $payload): VehicleData
    {
        return VehicleData::from(
            $this->createVehicle->handle(
                NewVehicleData::from($payload)
            )
        );
    }

    public function find(int $id): VehicleData
    {
        return VehicleData::from(
            $this->findVehicle->handle($id)
        );
    }

    public function update(int $id, array $payload): int
    {
        return $this->updateVehicle->handle(
            $id,
            UpdatedVehicleData::from($payload)
        );
    }

    public function delete(int $id): int
    {
        return $this->deleteVehicle->handle($id);
    }

    public function forceDelete(int $id): int
    {
        return $this->forceDeleteVehicle->handle($id);
    }
}
