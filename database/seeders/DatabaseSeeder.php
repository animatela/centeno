<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeds = [];

        if (app()->isLocal()) {
            $seeds[] = DemoSeeder::class;
        }

        $this->call($seeds);
    }
}
