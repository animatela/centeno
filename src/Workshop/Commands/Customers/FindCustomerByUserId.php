<?php

namespace Idat\Centeno\Workshop\Commands\Customers;

use App\Models\Workshop\Customer;
use Idat\Centeno\Workshop\Objects\Customers\NewCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class FindCustomerByUserId
{
    public function handle(int $userId): Model|Customer|null
    {
        return DB::transaction(
            callback: static fn () => Customer::query()->where('user_id', $userId)->first(),
            attempts: 2,
        );
    }
}
