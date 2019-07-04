<?php

namespace App\scrapers;

class Cima4u extends Scraper {    
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
                $server_link_page = Curl::post('http://live.cima4u.tv/structure/server.php?id='.$server_id,'');
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
