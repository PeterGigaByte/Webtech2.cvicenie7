<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
include_once "config/config.php";
date_default_timezone_set($json->timezone);
$date = date('Y-m-d H:i:s', time());
$ipA = $json->query;
$latitude = $json->lat;
$longitude = $json->lon;
$country_name = $json->country;
$region = $json->regionName;
$cityName =  $json->city;
$gps = "latitude: " . $latitude . " " . "longitude: " . $longitude;
$countryCode = $json->countryCode;

$query = "INSERT INTO visitors (ip, site, dateTime, country, country_code, city)
                        VALUES('$ipA','$site','$date','$country_name','$countryCode','$cityName')";
mysqli_query($db, $query);