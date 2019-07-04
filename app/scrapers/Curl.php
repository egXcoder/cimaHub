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
    public static function post($url,$data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        curl_close ($curl);
        return $output;
    }
}
