<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\Weather;

class WeatherTwoMinutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get weather every two minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        broadcast(new Weather());
        return 0;
    }
}
