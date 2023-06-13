<?php

namespace Idat\Centeno\Workshop\Commands\Customers;

use App\Models\Workshop\Customer;
use Illuminate\Support\Facades\DB;

class DestroyCustomer
{
    public function handle(int $id): int
    {
        return DB::transaction(
            callback: static fn () => Customer::query()->where('id', $id)->forceDelete(),
            attempts: 2,
        );
    }
}
