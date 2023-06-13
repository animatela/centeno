<?php

namespace Idat\Centeno\Workshop\Commands\Customers;

use App\Models\Workshop\Customer;
use Idat\Centeno\Workshop\Objects\Customers\ExistingCustomer;
use Illuminate\Support\Facades\DB;

final class UpdateCustomer
{
    public function handle(int $id, ExistingCustomer $customer): int
    {
        return DB::transaction(
            callback: static fn () => Customer::query()->where('id', $id)->update($customer->toArray()),
            attempts: 2,
        );
    }
}
