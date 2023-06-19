<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Illuminate\Support\Facades\DB;

class ForceDeleteService
{
    public function handle(int $id): int
    {
        return DB::transaction(
            callback: static fn () => Service::whereId($id)->forceDelete(),
            attempts: 2,
        );
    }
}
