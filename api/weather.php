<?php
include "api/script.php";
$site = "index";
//https://ipapi.co/api/
//https://home.openweathermap.org/
$apiKey = "b8c909bee77c78576a5f1f5802cc5a8a";
$ip = $_SERVER['REMOTE_ADDR'];
$json = json_decode(downloadPage($ip));
$city = $json->city;
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();

include_once "saveToDaTaBaSe.php";
