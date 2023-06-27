<?php

namespace Idat\Centeno\Workshop\Repositories;

use Idat\Centeno\Workshop\Commands\Services\CreateNewService;
use Idat\Centeno\Workshop\Commands\Services\DeleteService;
use Idat\Centeno\Workshop\Commands\Services\FindService;
use Idat\Centeno\Workshop\Commands\Services\ForceDeleteService;
use Idat\Centeno\Workshop\Commands\Services\ListServices;
use Idat\Centeno\Workshop\Commands\Services\UpdateService;
use Idat\Centeno\Workshop\Objects\Services\NewServiceData;
use Idat\Centeno\Workshop\Objects\Services\ServiceData;
use Idat\Centeno\Workshop\Objects\Services\UpdatedServiceData;
use Illuminate\Support\Collection;

final class ServiceRepository
{
    public function __construct(
        private readonly ListServices $listServices,
        private readonly CreateNewService $createNewService,
        private readonly FindService $findService,
        private readonly UpdateService $updateService,
        private readonly DeleteService $deleteService,
        private readonly ForceDeleteService $forceDeleteService,
    ) {}

    public function list(): Collection
    {
        return $this->listServices->handle()->map(
            fn ($service) => ServiceData::from($service)
        );
    }

    public function create(array $payload): ServiceData
    {
        return ServiceData::from(
            $this->createNewService->handle(
                NewServiceData::from($payload)
            )
        );
    }

    public function find(int $id, bool $items = false): ServiceData
    {
        return ServiceData::from(
            $this->findService->handle($id, $items)
        );
    }

    public function update(int $id, array $payload): int
    {
        return $this->updateService->handle(
            $id,
            UpdatedServiceData::from($payload)
        );
    }

    public function delete(int $id): int
    {
        return $this->deleteService->handle($id);
    }

    public function forceDelete(int $id): int
    {
        return $this->forceDeleteService->handle($id);
    }
}
