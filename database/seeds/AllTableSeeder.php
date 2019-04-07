<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use function Opis\Closure\unserialize;
use App\Movie;

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
        for ($i = 0; $i < 10; $i++) {
            factory('App\Movie')->create([
                'name' => $movies[$i]['name'],
                'description' => $movies[$i]['description'],
                'slug' => static::getSlug($movies[$i]['name']),
                'image_url' => $movies[$i]['image_url'],
                'category_id' => $movies[$i]['category_id'],
                'server_links' => static::createServerLinksForMovies($movies, $i)
            ]);
        }
        Movie::removeDuplications();
        Movie::populateQualityToDatabase();
        Movie::populateRatingsToDatabase();
    }

    private static function createServerLinksForMovies($movies, $i)
    {
        return factory('App\ServerLinksForMovies')->create([
            'server_1' => static::testServer($movies[$i]['servers'][0]),
            'server_2' => static::testServer($movies[$i]['servers'][1]),
            'server_3' => static::testServer($movies[$i]['servers'][2]),
            'server_4' => static::testServer($movies[$i]['servers'][3]),
            'server_5' => static::testServer($movies[$i]['servers'][4]),
            'server_6' => static::testServer($movies[$i]['servers'][5]),
            'server_7' => static::testServer($movies[$i]['servers'][6]),
            'server_8' => static::testServer($movies[$i]['servers'][7]),
            'server_9' => static::testServer($movies[$i]['servers'][8]),
            'server_10' => static::testServer($movies[$i]['servers'][9]),
        ])->id;
    }

    public static function getSlug($name)
    {
        $name_without_arabic = trim(preg_replace('![^A-Za-z0-9\s-]!', '', $name));
        return str_slug($name_without_arabic);
    }

    public static function testServer($server_url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $server_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $page = curl_exec($curl);
        $errors = ['sorry','not found','Video has not been found'];
        foreach($errors as $error){
            if(preg_match('!.'.$error.'!i', $page, $matches)){
                return null;
            }
        }
        return $server_url;
    }
}
