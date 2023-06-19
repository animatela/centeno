<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Illuminate\Database\Eloquent\Model;

final class FindService
{
    public function handle(int $id): Model|Service
    {
        return Service::query()->find($id);
    }
}
