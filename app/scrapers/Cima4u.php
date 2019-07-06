<?php

namespace App\scrapers;

class Cima4u extends Scraper {
    public function __construct($category,$page_number) {
        if($category == 'english'){
            $this->category_id = 1;
            $this->url = ($page_number == 1) 
                ? 'http://ww.cima4u.tv/category/%D8%A7%D9%81%D9%84%D8%A7%D9%85-%D8%A7%D8%AC%D9%86%D8%A8%D9%8A-movies-english/'
                : 'http://ww.cima4u.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d8%a7%d8%ac%d9%86%d8%a8%d9%8a-movies-english/page/' . $page_number . '/';
        }
        if($category == 'indian'){
            $this->category_id = 4;
            $this->url = ($page_number == 1) 
                ? 'http://ww.cima4u.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%87%d9%86%d8%af%d9%8a-indian-movies/'
                : 'http://ww.cima4u.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%87%d9%86%d8%af%d9%8a-indian-movies/page/' . $page_number . '/';
        }
        if($category == 'animation'){
            $this->category_id = 3;
            $this->url = ($page_number == 1) 
                ? 'http://ww.cima4u.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%83%d8%b1%d8%aa%d9%88%d9%86-movies-anime-cartoon/'
                : 'http://ww.cima4u.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%83%d8%b1%d8%aa%d9%88%d9%86-movies-anime-cartoon/page/' . $page_number . '/';
        }
        $this->AllMoviespage = Curl::execute($this->url);
    }

    public function buildMoviesArray() {
        $movies['links'] = $this->match('!<div class="block">\n<a href="(.+)">!');
        $movies['image_url'] = $this->match('!class="img1" style="background-image:url\((.+)\);">!');

        $array = $this->match('!class="boxtitle">(.+)<\/div>!');
        $movies['name'] = $this->entityDecode($array);

        $array = $this->match('!class="boxdetil">(.+)<\/div>!');
        $movies['description'] = $this->entityDecode($array);
        return $movies;
    }

    public function buildServersArray($moviesLinks) {
        $servers = [];
        for ($i = 0;$i < count($moviesLinks);$i++) {
            $link = $moviesLinks[$i];
            $singleMoviePage = Curl::execute($link);
            preg_match('!button--round-s" href="(.+)">!', $singleMoviePage, $matches);
            $newLink = $matches[1];
            $singleMoviePage = Curl::execute($newLink);

            preg_match_all('!href="" data-link="([0-9]+)"!',$singleMoviePage,$matches);
            $server_ids = $matches[1];

            $movie_servers = [];
            foreach($server_ids as $server_id){
                $server_link_page = Curl::post('http://live.cima4u.tv/structure/server.php?id=' . $server_id,'');
                $server_link_page = preg_replace('!\s*!','',$server_link_page);
                preg_match('!src="(.+)"SCROLLING!i', $server_link_page, $matches);

                if (array_key_exists(1,$matches)) {
                    try {$movie_servers[] = $matches[1];}
                    catch (\Exception $ex) {echo $ex->getMessage();}
                } else {
                    break;
                }
            }
            $servers[] = $movie_servers;
            echo '.';
            sleep(1);
        }
        return $servers;
    }
}
