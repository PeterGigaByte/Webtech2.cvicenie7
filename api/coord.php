<?php
include_once "../config/config.php";
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    // set response code - 503 service unavailable
    http_response_code(405);

    // tell the user
    echo json_encode(array("message" => "Method not allowed."));
    // The request is using the POST method
    exit();
}
$marks_map_query =
    "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE)+ip)), City, Latitude, Longitude
                    FROM visitors
                    GROUP BY city,latitude,longitude";


$result = mysqli_query($db, $marks_map_query);
$marks_map = mysqli_fetch_all($result);
$mark_arr=array();
$mark_arr["records"]=array();
foreach ($marks_map as $mark_map){
$product_item=array(
    "count" => $mark_map[0],
    "city" => $mark_map[1],
    "latitude" => $mark_map[2],
    "longitude" => $mark_map[3],
);
// set response code - 200 OK
http_response_code(200);
array_push($mark_arr["records"], $product_item);
}
// show products data in json format
echo json_encode($mark_arr);