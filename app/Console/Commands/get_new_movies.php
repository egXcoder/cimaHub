<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\CimaFree;
use App\Scrapers\CimaFlash;

class get_new_movies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:fetch {sitename=cimafree} {page_number=1}';

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
        if($this->argument('sitename') == 'cimafree'){
            $cimafree = new CimaFree($this->argument('page_number'));
            $cimafree->run(1);
        }
        if($this->argument('sitename') == 'cimaflash'){
            $cimaflash = new CimaFlash('http://www.cimaflash.co/category/%D8%A7%D9%81%D9%84%D8%A7%D9%85-%D8%A7%D8%AC%D9%86%D8%A8%D9%8A%D8%A9-q3c53/page/',$this->argument('page_number'));
            $cimaflash->run(1);
        }
    }
}
