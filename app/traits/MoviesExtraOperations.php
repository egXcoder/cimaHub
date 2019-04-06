<?php
namespace App\traits;

trait MoviesExtraOperations{
public function getName()
    {
        $only_english = $this->getNameWithoutArabic($this->name);
        $name_without_numbers = $this->getNameWithoutNumbers($only_english);
        $name_pure = $this->getNameWithoutQuality($name_without_numbers);
        return trim($name_pure);
    }
    
    public function getNameWithoutArabic($name)
    {
        return trim(preg_replace('![^A-Za-z0-9\s-]!', '', $this->name));
    }

    public function getNameWithoutNumbers($name)
    {
        return trim(preg_replace('!([0-9])!', '', $name));
    }

    public function getNameWithoutQuality($name)
    {
        $qualities = ['BluRay', 'DVDRip', 'HDCam', 'HDRip', 'HDTV', 'Web-dl'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!";
            if (preg_match($pattern, $name, $matches)) {
                return trim(preg_replace($pattern, '', $name));
            }
        }
        return $name;
    }

    public function getYearFromName($name)
    {
        if (preg_match('!(19[0-9]{2}|20[0-2][0-9])!', $name, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function getQualityFromName($name)
    {
        $qualities = ['Web-dl','BluRay', 'DVDRip','HDTC','HDTS', 'HDCam', 'HDRip', 'HDTV','HD'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!i";
            if (preg_match($pattern, $name, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }


    public function getRatingsFromImbd($movie_name)
    {
        $url = 'http://www.omdbapi.com/?t=' . urlencode($movie_name) . '&apikey=49f28901';
        if($this->ratings==null){
            $obj = json_decode(file_get_contents($url), true);
            if(array_key_exists('imdbRating', $obj)){return $obj['imdbRating'];}
        }
        return null;
    }

    public static function populateRatingsToDatabase()
    {
        Movie::latest()->each(function ($movie) {
            $name = $movie->getName();
            $ratings = $movie->getRatingsFromImbd(trim($name));
            if ($ratings != null && $ratings != 'N/A') {
                $movie->update(['ratings' => $ratings]);
            }
            if($movie->ratings===null){
                $movie->update(['ratings' => 0]);
            }
        });
    }

    public static function populateQualityToDatabase()
    {
        Movie::latest()->each(function ($movie) {
            $name = $movie->name;
            $description = $movie->description;
            $quality = $movie->getQualityFromName($name);
            $quality2 = $movie->getQualityFromName($description);
            if ($quality != null&& $movie->quality!='0') {
                $movie->update(['quality' => $quality]);
            }else if($quality2 != null&& $movie->quality!='0'){
                $movie->update(['quality' => $quality2]);
            }else{
                $movie->update(['quality' => '0']);
            }
        });
    }
    public static function removeDuplications(){
        $duplications_id = [];

        Movie::latest()->each(function($movie) use (&$duplications_id){
            $duplication = Movie::where('name','like','%'.$movie->getName().'%')
                ->where('id','!=',$movie->id)
                ->where('ratings',$movie->ratings)
                ->where('quality',$movie->quality)
                ->first();
    
                if ($duplication != null && !in_array($movie->id,$duplications_id)) {
                    $duplications_id [] = $duplication->id;
                     Movie::find($duplication->id)->delete();
                }
        });
    }
}