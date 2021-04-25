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
$delete_visit_query =
    "delete from visitors
order by id desc limit 1";
$result = mysqli_query($db, $delete_visit_query);

