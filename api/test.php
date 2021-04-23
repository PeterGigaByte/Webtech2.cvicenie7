<?php
$ip = $_SERVER['REMOTE_ADDR'];
$address = "https://ipapi.co/178.41.220.0/json/";
$loc = file_get_contents($address);
echo $loc;
$obj = json_decode($loc);