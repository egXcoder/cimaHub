<?php

namespace App\scrapers;

use App\Movie;
use App\ServerLinksForMovies;
use App\Actor;

class Cleaner {
    public static function run() {
        echo "Removing Movies Duplications ...\n";
        Movie::removeDuplications();
        echo "Removing non working Servers ...\n";
        static::remove_non_working_servers();
        echo "Removing Actors with no image ...\n";
        static::remove_actors_without_images();
        echo "Removing Servers not pointing to movies ...\n";
        static::remove_servers_not_pointing_to_movies();
        echo "Removing Movies not pointing to servers  ...\n";
        static::remove_movies_not_pointing_to_servers();
        echo "Removing Movies with no server  ...\n";
        static::remove_movies_with_no_servers();
        echo "Removing unused image files  ...\n";
        static::remove_unused_image_files();
        echo "Removing movies with no images  ...\n";
        static::remove_movies_with_no_images();
    }
    public static function remove_non_working_servers(){
        ServerLinksForMovies::latest('id')->where('optimized',false)->take(10)->get()->each(function($serverLinks){
            $servers = $serverLinks->getserverLinksAsArray();
            $new_servers_array = [];
            foreach($servers as $server){
                $new_servers_array[] = TestServer::test_if_server_working_and_populate_download_link($server,$serverLinks->movie->id);    
            }
            $serverLinks->setServerLinks($new_servers_array);
            $serverLinks->update(['optimized'=>true]);
            echo ".";
        });
    }
    public static function remove_actors_without_images(){
        Actor::all()->each(function($actor){
            if($actor->image_url===null || $actor->image_url==='') $actor->delete();
        });
    }
    public static function remove_movies_with_no_images(){
        Movie::all()->each(function($movie){
           $image_url = $movie->getAttributes()['image_url'];
            if(preg_match('!^http://!',$image_url)||preg_match('!^https://!',$image_url)){
                try {
                    if(!file_get_contents($image_url)) $movie->delete();;
                }catch(\Exception $ex){$movie->delete();}
            }
            echo ".";
        });
    }

    public static function remove_unused_image_files() {
        $files = scandir(public_path('uploads/'));
        for ($i = 2;$i < count($files);$i++) {
            if (Movie::where('image_url', 'uploads/' . $files[$i])->get()->isEmpty()) {
                try { unlink(public_path('uploads/') . $files[$i]);} 
                catch (\Exception $ex) { echo $ex->getMessage();}
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
            if($movie->serverLinks===null) $movie->delete();
        });
    }
    public static function remove_servers_not_pointing_to_movies(){
        ServerLinksForMovies::all()->each(function($server){
            if($server->movie===null) $server->delete();
        });
    }
}
