<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use function Opis\Closure\unserialize;

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
        factory('App\Category')->create(['name' => 'افلام عربى']);
        factory('App\Category')->create(['name' => 'مسلسلات اجنبى']);
        factory('App\Category')->create(['name' => 'مسلسلات عربى']);
        factory('App\Category')->create(['name' => 'مسلسلات انمى']);
        factory('App\Category')->create(['name' => 'افلام انمى']);

        $movies = unserialize(Storage::disk('local')->get('serializedMovieArray.txt'));
        for ($i = 0; $i < count($movies); $i++) {
            factory('App\Movie')->create([
                'name' => $movies[$i]['name'],
                'description' => $movies[$i]['description'],
                'image_url' => $movies[$i]['image_url'],
                'category_id' => 1,
                'server_links' => static::createServerLinksForMovies($movies, $i)
            ]);
        }
    }

    private static function createServerLinksForMovies($movies, $i)
    {
        return factory('App\ServerLinksForMovies')->create([
            'server_1' => $movies[$i]['servers'][0],
            'server_2' => $movies[$i]['servers'][1],
            'server_3' => $movies[$i]['servers'][2],
            'server_4' => $movies[$i]['servers'][3],
            'server_5' => $movies[$i]['servers'][4],
            'server_6' => $movies[$i]['servers'][5],
            'server_7' => $movies[$i]['servers'][6],
            'server_8' => $movies[$i]['servers'][7],
            'server_9' => $movies[$i]['servers'][8],
            'server_10' => $movies[$i]['servers'][9],
        ])->id;
    }
}
