<?php

namespace Database\Seeders\Dummy;

use App\Models\User;
use App\Support\Traits\WithProgressBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DummyPublicUserSeeder extends Seeder
{
    use WithoutModelEvents;
    use WithProgressBar;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating users...');

        $emails = $this->fakeEmails(5);

        $users = $this->withProgressBar(
            $emails->count(),
            fn () => User::factory(1)->create([
                'email' => $emails->pop(),
                'password' => bcrypt('password'),
            ])
        );

        $this->command->info("{$users->count()} users were created.");
    }

    private function fakeEmails(int $maxItems, string $domain = 'example.com'): Collection
    {
        return collect(range(1, $maxItems))->mapWithKeys(
            fn ($number) => [$number => 'customer_'.Str::padLeft($number, 2, 0).'@'.$domain]
        )->reverse();
    }
}
