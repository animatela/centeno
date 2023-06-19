<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Idat\Centeno\Workshop\Objects\Services\UpdatedServiceData;
use Illuminate\Support\Facades\DB;

final class UpdateService
{
    public function handle(int $id, UpdatedServiceData $vehicle): int
    {
        return DB::transaction(
            callback: static fn () => Service::whereId($id)->update($vehicle->toArray()),
            attempts: 2,
        );
    }
}
