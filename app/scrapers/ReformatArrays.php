<?php
namespace App\scrapers;
class ReformatArrays
{
    // TODO:there is exploit here
    public static function download_image($image_url, $movie_name)
    {
        $movie_path = public_path('/uploads/').$movie_name . '.jpg';
        $image_data = Curl::execute($image_url);
        $file = fopen($movie_path, 'w');
        fwrite($file, $image_data);
        echo ".";
        fclose($file);
    }

    public static function reformat($moviesData, $serversData,$category_id)
    {
        $movies = [];
        for ($i = 0; $i < count($moviesData['links']); $i++) {
            $array = [];
            $array['name'] = html_entity_decode($moviesData['name'][$i]);
            $array['description'] = html_entity_decode($moviesData['description'][$i]);
            $array['links'] = $moviesData['links'][$i];
            $array['category_id'] = $category_id;
            $array['image_url'] = $moviesData['image_url'][$i];
            
            $servers = [];
            for ($j = 0;$j < 10;$j++) {
                if (array_key_exists($j, $serversData[$i])) {
                    $servers[] = $serversData[$i][$j];
                } else {
                    $servers[] = null;
                }
            }

            $array['servers'] = $servers;

            $movies[] = $array;
        }
        return $movies;
    }
}