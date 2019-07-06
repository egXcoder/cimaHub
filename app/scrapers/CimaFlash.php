<?php

namespace App\scrapers;

class CimaFlash extends Scraper { 
    public function __construct($category,$page_number) {
        if($category == 'english'){
            $this->category_id = 1;
            $this->url = ($page_number == 1) 
                ? 'http://www.cimaflash.co/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d8%a7%d8%ac%d9%86%d8%a8%d9%8a%d8%a9-q3c53/'
                : 'http://www.cimaflash.co/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d8%a7%d8%ac%d9%86%d8%a8%d9%8a%d8%a9-q3c53/page/' . $page_number . '/';
        }
        if($category == 'indian'){
            $this->category_id = 4;
            $this->url = ($page_number == 1) 
                ? 'http://www.cimaflash.co/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%87%d9%86%d8%af%d9%8a%d8%a9-q8196/'
                : 'http://www.cimaflash.co/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%87%d9%86%d8%af%d9%8a%d8%a9-q8196/page/' . $page_number . '/';
        }
        if($category == 'animation'){
            $this->category_id = 3;
            $this->url = ($page_number == 1) 
                ? 'http://www.cimaflash.co/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%83%d8%b1%d8%aa%d9%88%d9%86-q18f6/'
                : 'http://www.cimaflash.co/category/%d8%a7%d9%81%d9%84%d8%a7%d9%85-%d9%83%d8%b1%d8%aa%d9%88%d9%86-q18f6/page/' . $page_number . '/';
        }
        $this->AllMoviespage = Curl::execute($this->url);
    }

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
                preg_match_all('!iframe src="(.+)" height!', $server_link_page, $matches);

                if (array_key_exists(1,$matches[1]) && $matches[1][1] !== 'http://www.cimaflash.co/videojs/?stream=') {
                    try {$movie_servers[] = $matches[1][1];}
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
