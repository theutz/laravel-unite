<?php

namespace Theutz\Unite\Commands;

use Illuminate\Console\Command;

class UniteCommand extends Command
{
    public $signature = 'laravel-unite';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
