<?php

namespace App\scrapers;

class TestServer
{
    public static function test($server_url)
    {
        if ($server_url === null) {
            return null;
        }
        $server_url = static::fix_url($server_url);
        if (!static::isDomainUp($server_url)) {
            return null;
        }
        if (!static::test_if_server_allow_sandbox($server_url)) {
            return null;
        }
        if (!static::test_if_server_working($server_url)) {
            return null;
        }
        return $server_url;
    }

    public static function fix_url($server_url)
    {
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

    public static function test_if_server_allow_sandbox($server_url)
    {
        $servers_to_be_removed = ['thevid.tv', 'streamango', 'openload.co'];
        foreach ($servers_to_be_removed as $server) {
            if (preg_match('!.' . $server . '!i', $server_url, $matches)) {
                return false;
            }
        }
        return true;
    }

    public static function test_if_server_working($server_url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $server_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $page = curl_exec($curl);
        $errors = ['sorry', 'not found', 'has not been found', 'has been blocked', 'deleted', 'not available'];
        foreach ($errors as $error) {
            if (preg_match('!.' . $error . '!i', $page, $matches)) {
                return false;
            }
        }
        return true;
    }
}
