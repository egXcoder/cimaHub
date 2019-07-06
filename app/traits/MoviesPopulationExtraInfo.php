<?php

namespace App\traits;

use App\Movie;
use \Statickidz\GoogleTranslate;
use App\Actor;
use App\Scrapers\Curl;
use App\Genre;
use App\scrapers\TestServer;
use App\scrapers\ReformatArrays;

trait MoviesPopulationExtraInfo{
    public function initialize_imbd() {
        $movie_name = $this->getName();
        $url = 'http://www.omdbapi.com/?t=' . urlencode($movie_name) . '&apikey=49f28901&plot=full';
        return $url;
    }

    public function getExtraInfoFromImbd() {
        $url = $this->initialize_imbd();
        $array = [];
        $obj = [];
        try {
            $obj = json_decode(file_get_contents($url), true);
        } catch (\Exception $ex) {return $array;}

        if(array_key_exists('imdbRating', $obj)) $array['rating'] = $obj['imdbRating'];
        if(array_key_exists('Poster', $obj)) $array['image'] = $obj['Poster'];
        if(array_key_exists('Runtime', $obj)) $array['time_length'] = $obj['Runtime'];
        if(array_key_exists('Genre', $obj)) $array['genre'] = $obj['Genre'];
        if(array_key_exists('Actors', $obj)) $array['actors'] = $obj['Actors'];
        if(array_key_exists('Plot', $obj)) $array['description'] = $obj['Plot'];

        return $array;
    }

    public static function populateExtraInfoToDatabase($category_id) {
        Movie::latest('id')->Where('category_id', $category_id)->take(60)->get()->each(function ($movie) {
            $imdb_json_generated_array = $movie->getExtraInfoFromImbd();            
            static::populateGenre($movie,$imdb_json_generated_array);
            static::populateActors($movie,$imdb_json_generated_array);
            static::populateQuality($movie);
            static::populate_time_length($movie,$imdb_json_generated_array);
            static::populateRatings($movie,$imdb_json_generated_array);
            static::populateDescription($movie,$imdb_json_generated_array);
            static::populateImageUrl($movie,$imdb_json_generated_array);
            echo '.';
            sleep(1);
        });
    }

    public static function populateGenre($movie,$imdb_json_generated_array){
        if (!array_key_exists('genre', $imdb_json_generated_array)) return [];
        $genre = $imdb_json_generated_array['genre'];
        $genre_array = explode(', ',$genre);
        foreach($genre_array as $genre){
            if($genre === 'N/A') continue;
            if(Genre::where('name','like','%' . $genre . '%')->get()->isEmpty()){
                Genre::create(['name' => $genre]);
            }
            $id = Genre::where('name','like','%' . $genre . '%')->first();
            $movie->genre()->attach($id);
        }
    }

    public static function populateRatings($movie,$imdb_json_generated_array) {
        if (!array_key_exists('rating', $imdb_json_generated_array)) return [];
        $ratings = $imdb_json_generated_array['rating'];

        if ($ratings != null && $ratings != 'N/A') {
            $movie->update(['ratings' => $ratings]);
        }
        if ($movie->ratings === null) {
            $movie->update(['ratings' => 0]);
        }
    }

    public static function populateDescription($movie,$imdb_json_generated_array){
        if (!array_key_exists('description', $imdb_json_generated_array)) return [];
        $description = $imdb_json_generated_array['description'];

        if ($description != null && $description != 'N/A') {
            $source = 'en';
            $target = 'ar';
            $trans = new GoogleTranslate();
            $result = $trans->translate($source, $target, $description);
            $movie->update(['description' => $result]);
        }
    }

    public static function populateActors($movie,$imdb_json_generated_array){
        if (!array_key_exists('actors', $imdb_json_generated_array)) return [];
        $actors = $imdb_json_generated_array['actors'];

        $actors_array = explode(', ',$actors);
        foreach($actors_array as $actor){
            if($actors === 'N/A') continue;
            if(Actor::where('name','like','%' . $actor . '%')->get()->isEmpty()){
                $actorPage = Curl::execute('https://www.themoviedb.org/search/person?query=' . urlencode($actor));
                preg_match('!(https:\/\/image.tmdb.org\/t\/p\/w180.*) 2x!', $actorPage, $matches);
                Actor::create(['name' => $actor, 'image_url' => $matches[1] ?? null]);
            }
            $id = Actor::where('name','like','%' . $actor . '%')->first();
            $movie->actor()->attach($id);
        }
    }

    protected static function download_image($movie){
        try{
            $image_name = rand();
            ReformatArrays::download_image($movie->image_url,$image_name);
            $movie->update(['image_url' => 'uploads/' . $image_name . '.jpg']);
        }catch(\Exception $ex){
            echo $ex->getMessage();
        }
    }

    public static function populateImageUrl($movie,$imdb_json_generated_array) {
        if (!array_key_exists('image', $imdb_json_generated_array)){
            static::download_image($movie);
            return;
        }

        $image_url = $imdb_json_generated_array['image'];

        if ($image_url != null && $image_url != 'N/A') {
            if(!TestServer::isDomainUp($image_url)){
                static::download_image($movie);
                return;
            }else{
                $movie->update(['image_url' => $image_url]);
            }
        }
    }

    public static function populate_time_length($movie,$imdb_json_generated_array){
        if (!array_key_exists('time_length', $imdb_json_generated_array)) return;
        $time_length = $imdb_json_generated_array['time_length'];

        if ($time_length != null && $time_length != 'N/A') {
            $time_length = trim(preg_replace('![a-z]+!','',$time_length));
            $movie->update(['time_length' => $time_length]);
        }
    }

    public static function populateQuality($movie) {
        $name = $movie->name;
        $description = $movie->description;
        $quality = $movie->getQualityFromName($name);
        $quality2 = $movie->getQualityFromName($description);
        if ($quality != null && $movie->quality != '0') {
            $movie->update(['quality' => $quality]);
        } elseif ($quality2 != null && $movie->quality != '0') {
            $movie->update(['quality' => $quality2]);
        } else {
            $movie->update(['quality' => '0']);
        }
    }
}