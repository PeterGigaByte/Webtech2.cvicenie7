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
$country = isset($_GET['country']) ? $_GET['country'] : die();
$town_visits_query =
    "SELECT COUNT(DISTINCT(CAST(dateTime AS DATE))), City
                    FROM visitors
                    WHERE country='$country'
                    GROUP BY city";
$result = mysqli_query($db, $town_visits_query);
$town_visits = mysqli_fetch_all($result);
echo "<table style='background-color: #1F2739' ><thead><tr><th colspan='2'>Mestá</th><tr/></thead><tbody>";
foreach ($town_visits as $town_visit){
    echo "<td>$town_visit[1]</td>";
    echo "<td>$town_visit[0]</td>";
}
echo "</tbody></table>";
