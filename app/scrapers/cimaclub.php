<?php

namespace App\scrapers;

use App\scrapers\Curl;
use App\scrapers\ReformatArrays;
use App\scrapers\InsertMovieToDatabase;
use App\Movie;

class CimaClub{
    public $AllMoviespage;
    public $url;
    
    public function __construct($url){
    $this->url = $url;
    $this->AllMoviespage = Curl::execute($url);
    }

    public static function automate(){
        for($i=21;$i<26;$i++){
            $x = new CimaClub('http://cimaclub.com/category/%D8%A7%D9%81%D9%84%D8%A7%D9%85-%D8%A7%D8%AC%D9%86%D8%A8%D9%8A/page/'.$i.'/');
            $x->run(1);
        }
        App\scrapers\Cleaner::run();
    }

    public function run($category_id){
        $movies = $this->buildMoviesArray();
        echo "Movies Array Built, Now Building Server Array ...\n";
        $servers = $this->buildServersArray($movies['links']);
        echo "\nServers Array Built, Now Reformatting Array And Downloading Images ...\n";
        $formatted = ReformatArrays::reformat($movies, $servers, $category_id);
        echo "\nFormatted Array Built, Now Inserting Movies and its servers to database After Testing Servers\n";
        InsertMovieToDatabase::insert($formatted);
        echo "\nInserted Successfully, Now Populating Ratings and Qualities And Imdb Images\n";
        Movie::populateExtraInfoToDatabase($category_id);
        echo "\nRating and qualities and images updated Successfully...";
        return "\nsuccess";
    }
    
    public function buildMoviesArray(){
        $movies['links'] = $this->match('!<div class="movie">\n<a href="(.*)\/">!');
        $movies['image_url']=$this->match('!<img alt=".* src="(.*)" width!');
        
        $array=$this->match('!class="boxcontentFilm">\n<h2>(.*)<\/h2>\n<p>.*<\/p>!');
        $movies['name']=$this->entityDecode($array);
        $array = $this->match('!class="boxcontentFilm">\n<h2>.*<\/h2>\n<p>(.*)<\/p>!');
        $movies['description'] = $this->entityDecode($array);
        return $movies;
    }
    public function match($regexPattern){
        preg_match_all($regexPattern, $this->AllMoviespage, $matches);
        return $matches[1];
    }
    public function entityDecode($array){
        foreach ($array as $item) {
            $array[] = html_entity_decode($item);
        }
        return $array;
    }    
    public function buildServersArray($moviesLinks){
        $servers = [];
        for ($i = 0;$i < count($moviesLinks);$i++) {
            $link = $moviesLinks[$i];
            $singleMoviePage = Curl::execute($link . '/?view=1');
            preg_match('!data: \'(.*)\'\+\$!', $singleMoviePage, $matches);
            $variable = $matches[1];
            $movie_servers = [];

            for ($j = 1;$j < 11;$j++) {
                $server_link_page = Curl::execute('http://cimaclub.com/wp-content/themes/Cimaclub/servers/server.php?' . $variable . $j);
                preg_match('!src=([a-z0-9:\/.-]*)!i', $server_link_page, $matches);

                if (array_key_exists(1, $matches)) {
                    $link = $matches[1];
                    if (preg_match('![1-9]!', $link)) {
                        $movie_servers[] = $link;
                    }
                } else {
                    break;
                }
            }
            $servers[] = $movie_servers;
        }
        return $servers;
    }
}
