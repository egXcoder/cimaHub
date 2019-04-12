<?php

namespace App\traits;

use App\Movie;

trait MoviesExtraOperations
{
    public function getName()
    {
        $only_english = $this->getNameWithoutArabic();
        $name_without_numbers = $this->getNameWithoutNumbers($only_english);
        $name_pure = $this->getNameWithoutQuality($name_without_numbers);
        return trim($name_pure);
    }

    public function getNameWithoutArabic()
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
            $pattern = "!($quality)!i";
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
        $qualities = ['Web-dl', 'BluRay', 'DVDRip', 'HDTC', 'HDTS', 'HDCam', 'HDRip', 'HDTV', 'HD'];
        foreach ($qualities as $quality) {
            $pattern = "!($quality)!i";
            if (preg_match($pattern, $name, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public function initialize_imbd()
    {
        $movie_name = $this->getName();
        $url = 'http://www.omdbapi.com/?t=' . urlencode($movie_name) . '&apikey=49f28901';
        return $url;
    }

    public function getRatingsAndImagesFromImbd()
    {
        $url = $this->initialize_imbd();
        $array = [];
        $obj = [];
        if ($this->ratings == null || !preg_match('!^http!', $this->attributes['image_url'])) {
            try {
                $obj = json_decode(file_get_contents($url), true);
            } catch (\Exception $ex) {
                return $array;
            }

            if (array_key_exists('imdbRating', $obj)) {
                $array['rating'] = $obj['imdbRating'];
            }
            if (array_key_exists('Poster', $obj)) {
                $array['image'] = $obj['Poster'];
            }
        }
        return $array;
    }

    public static function populateRatingsAndQualityAndImbdImageToDatabase($category_id)
    {
        if ($category_id == 2) {
            return;
        }
        Movie::latest('id')->Where('category_id', $category_id)->take(200)->get()->each(function ($movie) {
            static::populateRatingsToDatabase($movie);
            static::populateQualityToDatabase($movie);
            static::populateImageUrlToDatabase($movie);
        });
    }

    public static function populateRatingsToDatabase($movie)
    {
        $RatingsAndImages = $movie->getRatingsAndImagesFromImbd();
        if (!array_key_exists('rating', $RatingsAndImages)) {
            return [];
        }
        $ratings = $RatingsAndImages['rating'];
        if ($ratings != null && $ratings != 'N/A') {
            $movie->update(['ratings' => $ratings]);
        }
        if ($movie->ratings === null) {
            $movie->update(['ratings' => 0]);
        }
    }

    public static function populateImageUrlToDatabase($movie)
    {
        $RatingsAndImages = $movie->getRatingsAndImagesFromImbd();
        if (!array_key_exists('image', $RatingsAndImages)) {
            return;
        }
        $image_url = $RatingsAndImages['image'];
        if ($image_url != null && $image_url != 'N/A') {
            try {
                unlink(public_path() . '/' . $movie->attributes['image_url']);
            } catch (\Exception $ex) {
            }

            $movie->update(['image_url' => $image_url]);
        }
    }

    public static function populateQualityToDatabase($movie)
    {
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

    public static function removeDuplications($category_id)
    {
        $duplications_id = [];
        if ($category_id == 2) {
            return;
        }
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
                    unlink(public_path() . '/' . $movie->attributes['image_url']);
                } catch (\Exception $ex) {
                }
                Movie::find($duplication->id)->delete();
            }
        });
    }
}
