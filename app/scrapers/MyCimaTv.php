<?php

namespace App\scrapers;

class MyCimaTv extends Scraper {   
    public function __construct($category,$page_number) {
        if($category == 'english'){
            $this->category_id = 1;
            $this->url = ($page_number == 1) 
                ? 'https://tv.mycima.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-film/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d8%a7%d8%ac%d9%86%d8%a8%d9%8a-movies-english/'
                : 'https://tv.mycima.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-film/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d8%a7%d8%ac%d9%86%d8%a8%d9%8a-movies-english/page/' . $page_number . '/';
        }
        if($category == 'indian'){
            $this->category_id = 4;
            $this->url = ($page_number == 1) 
                ? 'https://tv.mycima.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-film/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%87%d9%86%d8%af%d9%89/'
                : 'https://tv.mycima.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-film/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%87%d9%86%d8%af%d9%89/page/' . $page_number . '/';
        }
        if($category == 'animation'){
            $this->category_id = 3;
            $this->url = ($page_number == 1) 
                ? 'https://tv.mycima.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-film/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%83%d8%b1%d8%aa%d9%88%d9%86/'
                : 'https://tv.mycima.tv/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-film/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%83%d8%b1%d8%aa%d9%88%d9%86/page/' . $page_number . '/';
        }
        $this->AllMoviespage = Curl::execute($this->url);
    }

    public function buildMoviesArray() {
        $movies['links'] = $this->match('!class="FigureTitle"><a href="(.*)">!');
        $movies['image_url'] = $this->match('!<div class="snip1543after"><\/div>\n<img width=".+" height=".+" src="(.+)" class!');

        $array = $this->match('!class="FigureTitle"><a href=".*">(.*)<\/a>!');
        $movies['name'] = $this->entityDecode($array);

        $array = $this->match('!class="FigureTitle"><a href=".*">(.*)<\/a>!');
        $movies['description'] = $this->entityDecode($array);
        return $movies;
    }

    public function buildServersArray($moviesLinks) {
        $servers = [];
        for ($i = 0;$i < count($moviesLinks);$i++) {
            $link = $moviesLinks[$i];
            $singleMoviePage = Curl::execute($link);
            preg_match('!data:\'id=(.+)\',!', $singleMoviePage, $matches);
            $movie_id = $matches[1];

            $singleMoviePage = Curl::post('https://tv.mycima.tv/wp-content/themes/Mycima/Watch.php','id=' . $movie_id);
            preg_match_all('!data-server="(.+)" style!',$singleMoviePage,$matches);
            $server_ids = $matches[1];
            $movie_servers = [];

            foreach($server_ids as $server_id){
                $server_link_page = Curl::post('https://tv.mycima.tv/wp-content/themes/Mycima/Server.php','post=' . $movie_id . '&server=' . $server_id);
                $server_link_page = preg_replace('!\s*!','',$server_link_page);
                preg_match('!src="(.+)"height!', $server_link_page, $matches);

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
