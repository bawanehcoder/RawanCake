<?php

namespace App\Console\Commands;

use App\Services\OccasionService;
use Illuminate\Console\Command;

class CheckForOccasions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:occasions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending messages to users on official occasions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OccasionService::sendMessage();
    }
}
