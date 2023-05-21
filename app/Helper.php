<?php

// Get User's Geolocation

function get_local_time()
{

    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'http://ip-api.com/json/' . $ip;
    $tz = file_get_contents($url);
    if (json_decode($tz, true)['status'] && json_decode($tz, true)['status'] == "fail") {
        $tz = "Asia/Colombo";
    } else {
        $tz = json_decode($tz, true)['timezone'];
    }

    return $tz;
}
