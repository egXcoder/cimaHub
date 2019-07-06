<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\CimaFree;
use App\Scrapers\CimaFlash;
use App\scrapers\MyCimaTv;
use App\scrapers\Cima4u;
use PhpParser\Node\Stmt\Switch_;

class get_new_movies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:fetch {sitename=cimafree} {category=english} {page_number=1}';

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
        if($this->argument('sitename') == 'cimatv'){
            $cimatv = new MyCimaTv($this->argument('category') , $this->argument('page_number'));
            $cimatv->run();
        }
        if($this->argument('sitename') == 'cima4u'){
            $cima4u = new Cima4u($this->argument('category') , $this->argument('page_number'));
            $cima4u->run();
        }
        if($this->argument('sitename') == 'cimaflash'){
            $cimaflash = new CimaFlash($this->argument('category') , $this->argument('page_number'));
            $cimaflash->run();
        }
    }
}
