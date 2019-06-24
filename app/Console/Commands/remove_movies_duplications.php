<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Movie;
class remove_movies_duplications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove_movies_duplications';

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
        Movie::removeDuplications(1);
    }
}
