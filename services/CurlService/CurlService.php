<?php

namespace services\CurlService;

use Exception;

class CurlService
{
    protected $api_key;

    const DEF_REQ_HEADERS = ['x-rapidapi-host: v3.football.api-sports.io'];

    public function __construct()
    {
        $this->api_key = config('app.football_api_key');
    }

    /**
     * Trigger a POST request
     * @param $url
     * @param $parameters
     * @param array $headers
     * @return mixed
     */
    public function post($url, $parameters, $return, $headers = [])
    {
        $ch = curl_init();
        $postUrl = $url;
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters); //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array_merge(['x-rapidapi-key: ' . $this->api_key], $headers);
        $headers = array_merge(self::DEF_REQ_HEADERS, $headers);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $server_output = curl_exec($ch);
        curl_close($ch);

        if ($return == 1) {
            return  $server_output;
        } else {
            return json_decode($server_output);
        }
    }


    /**
     * Trigger a GET request
     * @param $url
     * @param array $headers
     * @return mixed
     */
    public function get($url, $headers = [])
    {
        $ch = curl_init();
        $postUrl = $url;
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $headers = array_merge(['x-rapidapi-key: ' . $this->api_key], $headers);
        $headers = array_merge(self::DEF_REQ_HEADERS, $headers);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $server_output = curl_exec($ch);

        curl_close($ch);

        return json_decode($server_output);
    }
}
