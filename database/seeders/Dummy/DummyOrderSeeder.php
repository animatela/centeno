<?php

namespace Database\Seeders\Dummy;

use App\Models\Order;
use App\Models\User;
use App\Models\Workshop\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyOrderSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(10)->create([
            'user_id' => User::all()->random(1)->first()->id,
            'customer_id' => Customer::all()->random(1)->first()->id,
            'service_id' => 1,
            'payment_id' => 1,
        ]);
    }
}
