<?php

namespace App\scrapers;

use App\Movie;
use App\ServerLinksForMovies;

class Cleaner {
    public static function run() {
        static::remove_servers_not_pointing_to_movies();
        static::remove_movies_not_pointing_to_servers();
        static::remove_movies_with_no_servers();
        static::remove_unused_image_files();
        static::fix_slug_movies();
    }

    public static function remove_unused_image_files() {
        $files = scandir(public_path('uploads/'));
        for ($i = 2;$i < count($files);$i++) {
            if (Movie::where('image_url', 'uploads/' . $files[$i])->get()->isEmpty()) {
                try {
                    unlink(public_path('uploads/') . $files[$i]);
                } catch (\Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        }
    }

    public static function remove_movies_with_no_servers() {
        Movie::all()->each(function ($movie) {
            $is_servers_exist = false;
            foreach ($movie->serverLinks->getserverLinksAsArray() as $server) {
                if ($server !== null) {
                    $is_servers_exist = true;
                }
            }
            if (!$is_servers_exist) {
                $movie->serverLinks->delete();
            }
        });
    }
    public static function remove_movies_not_pointing_to_servers(){
        Movie::all()->each(function($movie){
            if($movie->serverLinks===null){
                $movie->delete();
            } 
        });
    }
    public static function remove_servers_not_pointing_to_movies(){
        ServerLinksForMovies::all()->each(function($server){
            if($server->movie===null){
                $server->delete();
            } 
        });
    }

    public static function fix_slug_movies() {
        Movie::where('category_id', '1')->each(function ($movie) {
            $movie->update(['slug' => str_slug($movie->getNameWithoutArabic())]);
        });
        Movie::where('category_id', '2')->each(function ($movie) {
            $movie->update(['slug' => str_slug($movie->name)]);
        });
    }
}
