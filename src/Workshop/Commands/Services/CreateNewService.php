<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Idat\Centeno\Workshop\Objects\Services\NewServiceData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateNewService
{
    public function handle(NewServiceData $newService): Model|Service
    {
        return DB::transaction(
            callback: static fn () => Service::query()->create($newService->toArray()),
            attempts: 2,
        );
    }
}
