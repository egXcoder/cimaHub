<?php

namespace App\scrapers;

use App\Movie;

class Cleaner
{
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
    public static function fix_slug_for_arabic_movies(){
        Movie::all()->each(function($movie){
            $movie->update(['slug'=>str_slug($movie->name)]);
        });
    }
}
