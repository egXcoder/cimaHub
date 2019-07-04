<?php

namespace App\scrapers;

use App\Movie;

abstract class Scraper {
    public $AllMoviespage;
    public $url;

    public function __construct($url,$page_number) {
        $this->url = $url . $page_number . '/';
        $this->AllMoviespage = Curl::execute($this->url);
    }

    public function run($category_id) {
        $movies = $this->buildMoviesArray();
        echo "Movies Array Built, Now Building Server Array ...\n";
        $servers = $this->buildServersArray($movies['links']);
        echo "\nNow Reformatting Array ...\n";
        $formatted = ReformatArrays::reformat($movies, $servers, $category_id);
        echo "\nNow Inserting Movies,its servers and its download links to database After Testing Servers\n";
        InsertMovieToDatabase::insert($formatted);
        echo "\nInserted Successfully, Now Populating Extra info and also movies Images\n";
        Movie::populateExtraInfoToDatabase($category_id);
        echo "\nExtraInfo updated Successfully...\n";
        Cleaner::remove_actors_without_images();

        return "\nsuccess";
    }

    public function match($regexPattern) {
        preg_match_all($regexPattern, $this->AllMoviespage, $matches);
        return $matches[1];
    }

    public function entityDecode($array) {
        foreach ($array as $item) {
            $array[] = html_entity_decode($item);
        }
        return $array;
    }

    abstract protected function buildMoviesArray();

    abstract protected function buildServersArray($moviesLinks);
}
