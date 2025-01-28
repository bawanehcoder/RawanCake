<?php

namespace App\Console\Commands;

use App\Services\OccasionService;
use Illuminate\Console\Command;

class CheckForUserOccasions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:user_occasions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending messages to users on official user occasions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OccasionService::sendMessage();
    }
}
