<?php

namespace Idat\Centeno\Workshop\Commands\Customers;

use App\Models\Workshop\Customer;
use Idat\Centeno\Workshop\Objects\Customers\NewCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateNewCustomer
{
    public function handle(NewCustomer $customer): Model|Customer
    {
        return DB::transaction(
            callback: static fn () => Customer::query()->create($customer->toArray()),
            attempts: 2,
        );
    }
}
