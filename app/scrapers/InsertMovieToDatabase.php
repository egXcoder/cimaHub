<?php

namespace App\scrapers;

use App\Movie;
use App\ServerLinksForMovies;
use App\DownloadLinksForMovies;

class InsertMovieToDatabase
{
    public static function insert($formatted)
    {
        foreach ($formatted as $movie) {
            try {
                $movie_id = Movie::create([
                                'name' => $movie['name'],
                                'description' => $movie['description'],
                                'slug' => static::getSlug($movie['name']),
                                'year' => static::getYearFromName($movie['name']),
                                'image_url' => $movie['image_url'],
                                'category_id' => $movie['category_id']
                            ])->id;
                            
                DownloadLinksForMovies::create(['movie_id'=>$movie_id]);            
                static::insertServers($movie,$movie_id);
                echo ".";
            } catch (\Exception $ex) {
                echo $ex->getMessage() . "\n";
            }
        }
    }

    public static function insertServers($movie,$movie_id)
    {
        return ServerLinksForMovies::create([
            'movie_id' => $movie_id,
            'server_1' => TestServer::test($movie_id,$movie['servers'][0]),
            'server_2' => TestServer::test($movie_id,$movie['servers'][1]),
            'server_3' => TestServer::test($movie_id,$movie['servers'][2]),
            'server_4' => TestServer::test($movie_id,$movie['servers'][3]),
            'server_5' => TestServer::test($movie_id,$movie['servers'][4]),
            'server_6' => TestServer::test($movie_id,$movie['servers'][5]),
            'server_7' => TestServer::test($movie_id,$movie['servers'][6]),
            'server_8' => TestServer::test($movie_id,$movie['servers'][7]),
            'server_9' => TestServer::test($movie_id,$movie['servers'][8]),
            'server_10' => TestServer::test($movie_id,$movie['servers'][9])
        ]);
    }

    public static function getSlug($name){
        return str_slug($name,'-',false);
    }

    public static function getYearFromName($name) {
        if (preg_match('!(19[0-9]{2}|20[0-2][0-9])!', $name, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
