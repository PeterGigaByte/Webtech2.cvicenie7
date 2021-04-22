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
<?php




//https://ipapi.co/api/
//https://home.openweathermap.org/
$apiKey = "b8c909bee77c78576a5f1f5802cc5a8a";
$ip = $_SERVER['REMOTE_ADDR'];
$address = "https://ipapi.co/.$ip./city/";
$cityId = file_get_contents($address);
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

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

?>
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
                <thead>
                <tr>
                    <th>Krajina</th>
                    <th>Počet návštev</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>


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
