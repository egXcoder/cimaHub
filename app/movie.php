<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded=[];

    public function serverLinks()
    {
        return $this->hasMany('App\serverLinksMovies', 'id');
    }

    public function getImageUrlAttribute($url)
    {
        return asset('') . $url;
    }
    
    public function getName(){
        
        $only_english= trim(preg_replace('![^A-Za-z0-9\s-]!',"",$this->name));
        $name_without_numbers = preg_replace('!([0-9])!',"",$only_english);
        $name_without_quality = $this->removeQualityFromName($name_without_numbers);
        return trim($name_without_quality);
    }

    public function getYearFromName($name){
        if(preg_match('!(19[0-9]{2}|20[0-2][0-9])!', $name, $matches)){
            return $matches[1];
        }
        return null;
    }

    public function getQualityFromName($name){
        $qualities = ['BluRay','DVDRip','HDCam','HDRip','HDTV','Web-dl'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!";
            if (preg_match($pattern, $name, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
    
    public function removeQualityFromName($name){
        $qualities = ['BluRay', 'DVDRip', 'HDCam', 'HDRip', 'HDTV', 'Web-dl'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!";
            if (preg_match($pattern, $name, $matches)) {
                return preg_replace($pattern, '', $name);
            }
        }
        return $name;
    }

    public function getRatingsFromImbd($movie_name){
        
        $url = "http://www.omdbapi.com/?t=".urlencode($movie_name)."&apikey=49f28901";

        $obj=json_decode(file_get_contents($url),true);
        return array_key_exists('imdbRating',$obj)? $obj['imdbRating'] : null;
        
    }
    public static function populateRatingsToDatabase(){
        Movie::latest()->each(function($movie){
            $name = $movie->getName();
            $ratings = $movie->getRatingsFromImbd($name);
            if($ratings!=null&&$ratings!='N/A'){
                $movie->update(['ratings' => $ratings]);
            }
        });
    }
    public static function populateQualityToDatabase(){
        Movie::latest()->each(function($movie){
            $name = $movie->name;
            $quality = $movie->getQualityFromName($name);
            if($quality!=null){
                $movie->update(['quality' => $quality]);
            }
        });
    }


}
