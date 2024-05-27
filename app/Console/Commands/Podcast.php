<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPodcast;
use Illuminate\Console\Command;

class Podcast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:podcast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ProcessPodcast::dispatch();
    }
}
