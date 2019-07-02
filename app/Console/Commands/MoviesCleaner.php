<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\Cleaner;
class MoviesCleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:clean';

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
     * @return mixed
     */
    public function handle()
    {
        Cleaner::run();
    }
}
