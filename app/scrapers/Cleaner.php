<?php

namespace App\scrapers;

use App\Movie;

class Cleaner
{
    public static function run()
    {
        static::remove_unused_image_files();
        static::remove_movies_with_no_servers();
        static::fix_slug_movies();
    }

    public static function remove_unused_image_files()
    {
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

    public static function remove_movies_with_no_servers()
    {
        Movie::all()->each(function ($movie) {
            $is_servers_exist = false;
            foreach ($movie->serverLinks->first()->getserverLinksAsArray() as $server) {
                if ($server !== null) {
                    $is_servers_exist = true;
                }
            }
            if (!$is_servers_exist) {
                $movie->delete();
            }
        });
    }

    public static function fix_slug_movies()
    {
        Movie::where('category_id', '1')->each(function ($movie) {
            $movie->update(['slug' => str_slug($movie->getNameWithoutArabic())]);
        });
        Movie::where('category_id', '2')->each(function ($movie) {
            $movie->update(['slug' => str_slug($movie->name)]);
        });
    }
}
