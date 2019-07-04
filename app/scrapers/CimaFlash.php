<?php

namespace App\scrapers;

class CimaFlash extends Scraper {    
    public function buildMoviesArray() {
        $movies['links'] = $this->match('!class="BlockItem">\n\s*<a href="(.*)">!');
        $movies['image_url'] = $this->match('!class="BlockItem">\n\s*<a href=".*">\n\s*<img src="(.*)" height!');

        $array = $this->match('!class="TitleBlockMovieNormal">(.*)<\/div>!');
        $movies['name'] = $this->entityDecode($array);

        $array = $this->match('!class="DescBlockMovieNormal">(.*)<\/div>!');
        $movies['description'] = $this->entityDecode($array);
        return $movies;
    }

    public function buildServersArray($moviesLinks) {
        $servers = [];
        for ($i = 0;$i < count($moviesLinks);$i++) {
            $link = $moviesLinks[$i];
            $singleMoviePage = Curl::execute($link);
            preg_match('!Watch\/Server\.php\',\n\s*data:\s\'(.*)\'\+i\+!', $singleMoviePage, $matches);
            $variable = $matches[1];
            $movie_servers = [];

            for ($j = 1;$j < 11;$j++) {
                $server_link_page = Curl::execute('http://www.cimaflash.co/wp-content/themes/YourColor2/Interface/Ajax/Single/Watch/Server.php?' . $variable . $j);
                preg_match('!src="(.+)" height!', $server_link_page, $matches);
                if (array_key_exists(1,$matches) && $matches[1] !== 'http://www.cimaflash.co/videojs/?stream=') {
                    try {$movie_servers[] = $matches[1];}
                    catch (\Exception $ex) {echo $ex->getMessage();}
                } else {
                    break;
                }
            }

            $servers[] = $movie_servers;
            sleep(1);
            echo '.';
        }
        return $servers;
    }
}
