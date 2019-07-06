<?php

namespace App\traits;

use App\Movie;

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

    public static function removeDuplications() {
        $duplications_id = [];

        Movie::latest('id')->take(200)->get()->each(function ($movie) use (&$duplications_id) {
            $duplication = Movie::where('name', $movie->getName())
                ->where('id', '!=', $movie->id)
                ->first();
                if ($duplication != null && !in_array($movie->id, $duplications_id)) {
                $duplications_id[] = $duplication->id;
                $movie = Movie::find($duplication->id);
                try {
                    unlink(public_path() . '/' . $movie->getAttributes()['image_url']);
                } catch (\Exception $ex) {}
                echo $duplication->id;    
                Movie::find($duplication->id)->delete();
            }
        });
    }
}
