<?php
namespace App\scrapers;
use App\Movie;
use App\ServerLinksForMovies;

class InsertMovieToDatabase{
    public static function insert($formatted){
        foreach ($formatted as $movie) {
            Movie::create([
                'name' => $movie['name'],
                'description' => $movie['description'],
                'slug' => static::getSlug($movie['name']),
                'image_url' => $movie['image_url'],
                'category_id' => $movie['category_id'],
                'server_links' => static::insertServers($movie)
            ]);
        }
    }
    public static function insertServers($movie){
        return ServerLinksForMovies::create([
            'server_1' => static::testServer($movie['servers'][0]),
            'server_2' => static::testServer($movie['servers'][1]),
            'server_3' => static::testServer($movie['servers'][2]),
            'server_4' => static::testServer($movie['servers'][3]),
            'server_5' => static::testServer($movie['servers'][4]),
            'server_6' => static::testServer($movie['servers'][5]),
            'server_7' => static::testServer($movie['servers'][6]),
            'server_8' => static::testServer($movie['servers'][7]),
            'server_9' => static::testServer($movie['servers'][8]),
            'server_10' => static::testServer($movie['servers'][9])
        ])->id;
    }
    public static function getSlug($name)
    {
        $name_without_arabic = trim(preg_replace('![^A-Za-z0-9\s-]!', '', $name));
        return str_slug($name_without_arabic);
    }

    public static function testServer($server_url)
    {
        if($server_url===null) return null;
        
        $servers_to_be_removed=['thevid.tv','streamango','openload.co'];
        foreach ($servers_to_be_removed as $server) {
            if (preg_match('!.' . $server . '!i', $server_url, $matches)) {
                return null;
            }
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $server_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $page = curl_exec($curl);
        $errors = ['sorry', 'not found', 'Video has not been found', 'video has been blocked'];
        foreach ($errors as $error) {
            if (preg_match('!.' . $error . '!i', $page, $matches)) {
                return null;
            }
        }
        return $server_url;
    }

}