<?php

namespace App\Support\Traits;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

trait WithProgressBar
{
    public function withProgressBar(int $amount, Closure $callback): Collection
    {
        $output = $this->command->getOutput();
        $progress = new ProgressBar($output, $amount);
        $progress->start();

        $items = new Collection;

        for ($i = 0; $i < $amount; $i++) {
            $items = $items->concat($callback());
            $progress->advance();
        }

        $progress->finish();
        $output->writeln('');

        return $items;
    }
}
