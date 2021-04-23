<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
include_once "script.php";
$ip = $_SERVER['REMOTE_ADDR'];
$json = json_decode(downloadPage($ip));
$site = "traffic_history";
include_once "saveToDaTaBaSe.php";
$country_visits_query = "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE))), Country,Country_code
FROM visitors
GROUP BY country,country_code";
$result = mysqli_query($db, $country_visits_query);
$country_visits = mysqli_fetch_all($result);
$sites_visits_query = "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE))), Site
FROM visitors
GROUP BY site";
$result = mysqli_query($db, $sites_visits_query);
$sites_visits = mysqli_fetch_all($result);
$morning_visits_query = "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE)))
FROM visitors
where CAST(dateTime as time) >= '06:00:00' 
   and CAST(dateTime as time) < '15:00:00'";
$lunch_visits_query = "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE)))
FROM visitors
where CAST(dateTime as time) >= '15:00:00' 
   and CAST(dateTime as time) < '21:00:00'";
$evening_visits_query = "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE)))
FROM visitors
where CAST(dateTime as time) >= '21:00:00' 
   and CAST(dateTime as time) < '24:00:00'";
$night_visits_query = "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE)))
FROM visitors
where CAST(dateTime as time) >= '24:00:00' 
   and CAST(dateTime as time) < '06:00:00'";
$result = mysqli_query($db, $morning_visits_query);
$morning_visits = mysqli_fetch_assoc($result);
$morning_visits = $morning_visits["COUNT(DISTINCT(CAST(dateTime AS DATE)))"];
$result = mysqli_query($db, $lunch_visits_query);
$lunch_visits = mysqli_fetch_assoc($result);
$lunch_visits = $lunch_visits["COUNT(DISTINCT(CAST(dateTime AS DATE)))"];

$result = mysqli_query($db, $evening_visits_query);
$evening_visits = mysqli_fetch_assoc($result);
$evening_visits = $evening_visits["COUNT(DISTINCT(CAST(dateTime AS DATE)))"];

$result = mysqli_query($db, $night_visits_query);
$night_visits = mysqli_fetch_assoc($result);
$night_visits = $night_visits["COUNT(DISTINCT(CAST(dateTime AS DATE)))"];

