<?php

namespace Database\Seeders\Dummy;

use App\Models\User;
use App\Support\Traits\WithProgressBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyAdminSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating admin user...');

        $this->withProgressBar(1, fn () => $this->seedAdmin());

        $this->command->info('Admin user created.');
    }

    protected function seedAdmin()
    {
        return User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'centeno@arcnet.dev',
            'password' => bcrypt('password'),
        ]);
    }
}
