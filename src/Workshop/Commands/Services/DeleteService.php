<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Illuminate\Support\Facades\DB;

class DeleteService
{
    public function handle(int $id): int
    {
        return DB::transaction(
            callback: static fn () => Service::whereId($id)->delete(),
            attempts: 2,
        );
    }
}
