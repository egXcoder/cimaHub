<?php

namespace App\scrapers;

use App\Movie;
use App\ServerLinksForMovies;
use App\scrapers\TestServer;

class InsertMovieToDatabase
{
 

    public static function insert($formatted)
    {
        foreach ($formatted as $movie) {
            try {
                Movie::create([
                    'name' => $movie['name'],
                    'description' => $movie['description'],
                    'slug' => static::getSlug($movie['name']),
                    'image_url' => $movie['image_url'],
                    'category_id' => $movie['category_id'],
                    'server_links' => static::insertServers($movie)
                ]);
            } catch (\Exception $ex) {
                echo "x";
            }
        }
    }

    public static function insertServers($movie)
    {
        return ServerLinksForMovies::create([
            'server_1' => TestServer::test($movie['servers'][0]),
            'server_2' => TestServer::test($movie['servers'][1]),
            'server_3' => TestServer::test($movie['servers'][2]),
            'server_4' => TestServer::test($movie['servers'][3]),
            'server_5' => TestServer::test($movie['servers'][4]),
            'server_6' => TestServer::test($movie['servers'][5]),
            'server_7' => TestServer::test($movie['servers'][6]),
            'server_8' => TestServer::test($movie['servers'][7]),
            'server_9' => TestServer::test($movie['servers'][8]),
            'server_10' => TestServer::test($movie['servers'][9])
        ])->id;
    }

    public static function getSlug($name)
    {
        $name_without_arabic = trim(preg_replace('![^A-Za-z0-9\s-]!', '', $name));
        return str_slug($name_without_arabic);
    }

}
