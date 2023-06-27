<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Illuminate\Database\Eloquent\Model;

final class FindService
{
    public function handle(int $id, bool $items): Model|Service
    {
        $query = Service::query();

        if ($items) {
            $query->with('items');
        }

        return $query->find($id);
    }
}
