<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\CimaFree;

class get_new_movies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_new_movies {sitename=cimafree}';

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
        if($this->argument('sitename')=='cimafree'){
            $cimafree = new CimaFree(1);
            $cimafree->run(1);
        }
    }
}
