<?php

namespace App\scrapers;
use App\scrapers\Curl;
use App\scrapers\ReformatArrays;
use App\scrapers\InsertMovieToDatabase;
use App\Movie;

class CimaFree
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
        Movie::populateRatingsAndQualityAndImbdImageToDatabase($category_id);
        Movie::removeDuplications($category_id);
        return "\nsuccess";
    }

    public function buildMoviesArray()
    {
        $movies['links'] = $this->match('!class="details">\n<a class="link" href="(.*)" title!');
        $movies['image_url'] = $this->match('!data-src="(.*)" height!');

        $array = $this->match('!<figcaption>\n(.*)<\/figcaption>!');
        $movies['name'] = $this->entityDecode($array);
        $array = $this->match('!<span>القصة : <\/span>\n(.*)<\/p>!');
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
            $singleMoviePage = Curl::execute($link . '/?view=1');
            preg_match('!data: \'(.*)\'\+\$!', $singleMoviePage, $matches);
            $variable = $matches[1];
            $movie_servers = [];

            for ($j = 1;$j < 11;$j++) {
                $server_link_page = Curl::execute('http://cimafree.com/wp-content/themes/movie/server.php?' . $variable . $j);
                preg_match('!src="([a-z0-9:\/.-]*)"!i', $server_link_page, $matches);

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
