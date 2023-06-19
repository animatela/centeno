<?php

namespace Idat\Centeno\Workshop\Commands\Services;

use App\Models\Workshop\Service;
use Illuminate\Database\Eloquent\Collection;

final class ListServices
{
    /**
     * @return Collection<Service>
     */
    public function handle(): Collection
    {
        return Service::query()->get();
    }
}
