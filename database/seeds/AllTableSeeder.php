<?php

use Illuminate\Database\Seeder;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Category')->create(['name' => 'افلام اجنبى']);
        factory('App\Category')->create(['name' => 'مسلسلات اجنبى']);
        factory('App\Category')->create(['name' => 'مسلسلات انمى']);
        factory('App\Category')->create(['name' => 'افلام انمى']);
    }


}
