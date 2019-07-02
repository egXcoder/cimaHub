<?php

namespace App\scrapers;

use App\Movie;

class TestServer
{
    public static function test($movie_id,$server_url)
    {
        if ($server_url === null) return null;
        $server_url = static::fix_url($server_url);
        insert_download_links($movie_id,$server_url);
        if (!static::test_if_server_allow_sandbox($server_url)) return null;
        if (!static::test_if_server_working_and_populate_download_link($server_url,$movie_id)) return null;
        return $server_url;
    }

    public static function fix_url($server_url){
        return preg_replace('!^\/\/!', 'https://', $server_url);
    }

    public static function isDomainUp($server_url)
    {
        $curlInit = curl_init($server_url);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curlInit);
        curl_close($curlInit);
        return ($response) ? true : false;
    }

    public static function insert_download_links($movie_id,$server_url){
        /*set download link*/
        if(preg_match('!openload.co!',$server_url)||preg_match('!yourupload.com!',$server_url)||preg_match('!file_up.org!',$server_url||preg_match('!uptobox.com!',$server_url)||preg_match('!verystream.com!',$server_url))){
            $movie = Movie::find($movie_id);
            $movie->downloadLinks->set_download_link($server_url);
            return true;
        }
    }

    public static function test_if_server_allow_sandbox($server_url)
    {
        $servers_to_be_removed = ['thevid.tv', 'streamango', 'openload.co','upvid.co','verystream.com','streamcherry.com'];
        foreach ($servers_to_be_removed as $server) {
            if (preg_match('!.' . $server . '!i', $server_url, $matches)) {
                return false;
            }
        }
        return true;
    }

    public static function test_if_server_working_and_populate_download_link($server_url,$movie_id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $server_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $page = curl_exec($curl);

        /*test if domain up*/
        if(!$page) return false;

        /*test if server is working*/
        $errors = ['sorry', 'not found', 'has not been found', 'has been blocked', 'deleted', 'not available'];
        foreach ($errors as $error) {
            if (preg_match('!.' . $error . '!i', $page)) {
                return false;
            }
        }
        
        if(preg_match('!(http.+\.mp4)!',$page,$download_link_matches)){
            $movie = Movie::find($movie_id);
            $movie->downloadLinks->set_download_link($download_link_matches[1]);
            return true;
        }
        return true;
    }
}
