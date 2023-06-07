<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public const IMAGE_URL = 'https://source.unsplash.com/random/200x200/?img=1';

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'centeno@arcnet.dev',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory(10)->create();
    }
}
