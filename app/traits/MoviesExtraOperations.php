<?php

namespace App\traits;

use App\Movie;
use \Statickidz\GoogleTranslate;
use App\Actor;
use App\Scrapers\Curl;

trait MoviesExtraOperations {
    public function getName() {
        $only_english = $this->getNameWithoutArabic();
        $name_without_numbers = $this->getNameWithoutNumbers($only_english);
        $name_pure = $this->getNameWithoutQuality($name_without_numbers);
        return trim($name_pure);
    }

    public function getNameWithoutArabic() {
        return trim(preg_replace('![^A-Za-z0-9\s-]!', '', $this->name));
    }

    public function getNameWithoutNumbers($name) {
        return trim(preg_replace('!([0-9])!', '', $name));
    }

    public function getNameWithoutQuality($name) {
        $qualities = ['BluRay', 'DVDRip', 'HDCam', 'HDRip', 'HDTV', 'Web-dl'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!i";
            if (preg_match($pattern, $name, $matches)) {
                return trim(preg_replace($pattern, '', $name));
            }
        }
        return $name;
    }

    public function getYearFromName($name) {
        if (preg_match('!(19[0-9]{2}|20[0-2][0-9])!', $name, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function getQualityFromName($name) {
        $qualities = ['Web-dl', 'BluRay', 'DVDRip', 'HDTC', 'HDTS', 'HDCam', 'HDRip', 'HDTV', 'HD'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!i";
            if (preg_match($pattern, $name, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public function initialize_imbd() {
        $movie_name = $this->getName();
        $url = 'http://www.omdbapi.com/?t=' . urlencode($movie_name) . '&apikey=49f28901&plot=full';
        return $url;
    }

    public function getRatingsAndImagesFromImbd() {
        $url = $this->initialize_imbd();
        $array = [];
        $obj = [];
        try {
            $obj = json_decode(file_get_contents($url), true);
        } catch (\Exception $ex) {
            return $array;
        }
        
        if(array_key_exists('imdbRating', $obj)) $array['rating'] = $obj['imdbRating'];
        if(array_key_exists('Poster', $obj)) $array['image'] = $obj['Poster'];
        if(array_key_exists('Runtime', $obj)) $array['time_length'] = $obj['Runtime'];
        if(array_key_exists('Genre', $obj)) $array['genre'] = $obj['Genre'];
        if(array_key_exists('Actors', $obj)) $array['actors'] = $obj['Actors'];
        if(array_key_exists('Plot', $obj)) $array['description'] = $obj['Plot'];
    
        return $array;
    }

    public static function populateExtraInfoToDatabase($category_id) {
        
        Movie::latest('id')->Where('category_id', $category_id)->take(100)->get()->each(function ($movie) {
            $imdb_json_generated_array = $movie->getRatingsAndImagesFromImbd();            
            
            static::populateActors($movie,$imdb_json_generated_array);
            static::populate_time_length($movie,$imdb_json_generated_array);
            static::populateRatings($movie,$imdb_json_generated_array);
            static::populateDescription($movie,$imdb_json_generated_array);
            static::populateImageUrl($movie,$imdb_json_generated_array);
            static::populateQuality($movie);
            echo ".";
        });
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
        $actors_array = explode(", ",$actors);
        foreach($actors_array as $actor){
            if($actors==='N/A') continue;
            if(Actor::where('name','like','%'.$actor.'%')->get()->isEmpty()){
                $actorPage = Curl::execute('https://www.themoviedb.org/search/person?query='. urlencode($actor));
                preg_match('!(https:\/\/image.tmdb.org\/t\/p\/w180.*) 2x!', $actorPage, $matches);
                Actor::create(['name'=>$actor,'image_url'=>$matches[1]??null]);
            }
            $id = Actor::where('name','like','%'.$actor.'%')->first();
            $movie->actor()->attach($id);
        }
    }

    public static function populateImageUrl($movie,$imdb_json_generated_array) {
        if (!array_key_exists('image', $imdb_json_generated_array)) return;
        $image_url = $imdb_json_generated_array['image'];

        if ($image_url != null && $image_url != 'N/A') {
            try {
                unlink(public_path() . '/' . $movie->getAttributes()['image_url']);
            } catch (\Exception $ex) {
            }

            $movie->update(['image_url' => $image_url]);
        }
    }

    public static function populate_time_length($movie,$imdb_json_generated_array){
        if (!array_key_exists('time_length', $imdb_json_generated_array)) return;
        $time_length = $imdb_json_generated_array["time_length"];
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

    public static function removeDuplications($category_id) {
        $duplications_id = [];

        Movie::latest('id')->Where('category_id', $category_id)->take(200)->get()->each(function ($movie) use (&$duplications_id) {
            $duplication = Movie::where('name', 'like', '%' . $movie->getName() . '%')
                ->where('id', '!=', $movie->id)
                ->where('ratings', $movie->ratings)
                ->where('quality', $movie->quality)
                ->first();

            if ($duplication != null && !in_array($movie->id, $duplications_id)) {
                $duplications_id[] = $duplication->id;
                $movie = Movie::find($duplication->id);
                try {
                    unlink(public_path() . '/' . $movie->getAttributes()['image_url']);
                } catch (\Exception $ex) {}
                Movie::find($duplication->id)->serverLinks->delete();
            }
        });
    }
}
