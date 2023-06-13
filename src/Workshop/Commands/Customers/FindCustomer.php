<?php

namespace Idat\Centeno\Workshop\Commands\Customers;

use App\Models\Workshop\Customer;
use Idat\Centeno\Workshop\Objects\Customers\NewCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class FindCustomer
{
    public function handle(int $id): Model|Customer
    {
        return DB::transaction(
            callback: static fn () => Customer::query()->find($id),
            attempts: 2,
        );
    }
}
