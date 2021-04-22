<?php

$ip = $_SERVER['REMOTE_ADDR'];
$cityName = "https://ipapi.co/$ip/city/";
$ipA = "https://ipapi.co/$ip/ip/";
$latitude = "https://ipapi.co/$ip/latitude/";
$longitude = "https://ipapi.co/$ip/longitude/";
$country_name = "https://ipapi.co/$ip/country_name/";
$region = "https://ipapi.co/$ip/region/";

$cityName = file_get_contents($cityName);
$ipA = file_get_contents($ipA);
$gps = "latitude: ".file_get_contents($latitude)." "."longitude: ".file_get_contents($longitude);
$country_name = file_get_contents($country_name);
$region = file_get_contents($region);
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Cvičenie 7</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.14/dist/jBox.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.14/dist/jBox.all.min.css" rel="stylesheet">
    <script src="js/javascript.js"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="icon" href="images/icon.png">

</head>
<body>
<header>
    <nav class="navbar navbar-dark bg-dark">
        <nav class="nav">
            <a class="nav-link active" aria-current="page" href="/cvicenia/cvicenie7/index.php">Home</a>
            <a class="nav-link" href="/cvicenia/cvicenie7/details.php">Details</a>
            <a class="nav-link" href="/cvicenia/cvicenie7/traffic_history.php">Traffic history</a>
        </nav>
    </nav>
</header>

<div class="container border center mar-top">
    <main>
        <div class="row">
            <table id="table">
                <tbody>
                <tr>
                    <td>Ip adresa</td>
                    <td><?php echo $ipA; ?></td>
                </tr>
                <tr>
                    <td>GPS súradnice</td>
                    <td><?php echo $gps; ?></td>
                </tr>
                <tr>
                    <td>Mesto</td>
                    <td><?php echo $cityName; ?></td>
                </tr>
                <tr>
                    <td>Štát</td>
                    <td><?php echo $country_name; ?></td>
                </tr>
                <tr>
                    <td>Hlavné mesto</td>
                    <td><?php echo $region ; ?></td>
                </tr>
                </tbody>
            </table>
        </div>


    </main>

</div>
<div style="height: 50px"></div>
<footer class="footer">
    ©PeterRigoDevelopment
</footer>
<div id="loading" class="center-screen"><img class="loading-img" alt="ha"  src="images/loading.gif"></div>
<div id="overlay" class="overlay"></div>

</body>

</html>
