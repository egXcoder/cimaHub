<?php

namespace App\Scrapers;

use App\Movie;

class CimaFree {
    public $AllMoviespage;
    public $url;

    public function __construct($page_number) {
        $this->url = 'http://cimafree.com/category/%D8%A7%D9%81%D9%84%D8%A7%D9%85-%D8%A7%D8%AC%D9%86%D8%A8%D9%8A-q6f86/page/' . $page_number . '/';
        $this->AllMoviespage = Curl::execute($this->url);
    }

    public static function automate() {
        for ($i = 95;$i < 100;$i++) {
            $x = new CimaFree('http://cimafree.com/category/%D8%A7%D9%81%D9%84%D8%A7%D9%85-%D8%A7%D8%AC%D9%86%D8%A8%D9%8A-q6f86/page/' . $i . '/');
            $x->run(1);
        }
        Cleaner::run();
    }

    public function run($category_id) {
        $movies = $this->buildMoviesArray();
        echo "Movies Array Built, Now Building Server Array ...\n";
        $servers = $this->buildServersArray($movies['links']);
        echo "\nServers Array Built, Now Reformatting Array And Downloading Images ...\n";
        $formatted = ReformatArrays::reformat($movies, $servers, $category_id);
        echo "\nFormatted Array Built, Now Inserting Movies and its servers to database After Testing Servers\n";
        InsertMovieToDatabase::insert($formatted);
        echo "\nInserted Successfully, Now Populating Ratings and Qualities And Imdb Images\n";
        Movie::populateExtraInfoToDatabase($category_id);
        echo "\nExtraInfo updated Successfully...\n";
        Cleaner::remove_actors_without_images();
        return "\nsuccess";
    }

    public function buildMoviesArray() {
        $movies['links'] = $this->match('!class="details">\n<a class="link" href="(.*)" title!');
        $movies['image_url'] = $this->match('!data-src="(.*)" height!');

        $array = $this->match('!<figcaption>\n(.*)<\/figcaption>!');
        $movies['name'] = $this->entityDecode($array);

        $array = $this->match('!<span>القصة : <\/span>\n(.*)<\/p>!');
        $movies['description'] = $this->entityDecode($array);
        return $movies;
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

    public function buildServersArray($moviesLinks) {
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
            echo '.';
        }
        return $servers;
    }
}
