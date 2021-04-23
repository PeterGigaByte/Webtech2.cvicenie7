<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
include_once "script.php";
$ip = $_SERVER['REMOTE_ADDR'];
$json = json_decode(downloadPage($ip));
$site = "details";
include_once "saveToDaTaBaSe.php";
