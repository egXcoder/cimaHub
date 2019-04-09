<?php

namespace App\scrapers;

use App\scrapers\Curl;
use App\scrapers\ReformatArrays;
use App\scrapers\InsertMovieToDatabase;
use App\Movie;

class CimaFlash
{
    public $AllMoviespage;
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
        $this->AllMoviespage = Curl::execute($url);
    }

    public function run($category_id){
        $movies = $this->buildMoviesArray();
        $servers = $this->buildServersArray($movies['links']);
        $formatted = ReformatArrays::reformat($movies, $servers, $category_id);
        InsertMovieToDatabase::insert($formatted);
        Movie::populateRatingsAndQualityAndImbdImageToDatabase();
        Movie::removeDuplications();
        return "\nsuccess";
    }

    public function buildMoviesArray()
    {
        $movies['links'] = $this->match('!class="BlockItem">\n\s*<a href="(.*)">!');
        $movies['image_url'] = $this->match('!class="BlockItem">\n\s*<a href=".*">\n\s*<img src="(.*)" height!');

        $array = $this->match('!class="TitleBlockMovieNormal">(.*)<\/div>!');
        $movies['name'] = $this->entityDecode($array);
        $array = $this->match('!class="DescBlockMovieNormal">(.*)<\/div>!');
        $movies['description'] = $this->entityDecode($array);
        return $movies;
    }

    public function match($regexPattern)
    {
        preg_match_all($regexPattern, $this->AllMoviespage, $matches);
        return $matches[1];
    }

    public function entityDecode($array)
    {
        foreach ($array as $item) {
            $array[] = html_entity_decode($item);
        }
        return $array;
    }

    public function buildServersArray($moviesLinks)
    {
        $servers = [];
        for ($i = 0;$i < count($moviesLinks);$i++) {
        $link = $moviesLinks[$i];
        $singleMoviePage = Curl::execute($link);
        preg_match('!Watch\/Server\.php\',\n\s*data:\s\'(.*)\'\+i\+!', $singleMoviePage, $matches);
        $variable = $matches[1];

        $movie_servers = [];

        for ($j = 1;$j < 11;$j++) {
            $server_link_page = Curl::execute('http://www.cimaflash.co/wp-content/themes/YourColor2/Interface/Ajax/Single/Watch/Server.php?' . $variable . $j);
            preg_match('!src="(.*)" height!', $server_link_page, $matches);

            if ($matches[1] != 'http://www.cimaflash.co/videojs/?stream=') {
                $server_link_page = Curl::execute($matches[1]);
                preg_match('!style="display:none" src="(.*)" scrolling!', $server_link_page, $matches);
                $link = $matches[1];
                $movie_servers[] = $link;
            } else {
                break;
            }
        }

        $servers[] = $movie_servers;
    }

        return $servers;
    }
}
