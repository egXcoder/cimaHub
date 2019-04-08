<?php

namespace App\scrapers;

class Curl
{
    public static function execute($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
