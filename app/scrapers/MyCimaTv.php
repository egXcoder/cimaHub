<?php

namespace App\scrapers;

class MyCimaTv extends Scraper {    
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
