<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'centeno@arcnet.dev',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    }
}
