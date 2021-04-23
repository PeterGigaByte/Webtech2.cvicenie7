<?php
 include_once "api/weather.php";
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
            <div class="weather">
                <div class="report-container">
                    <h2><?php echo $data->name; ?> Weather Status</h2>
                    <div class="time">
                        <div><?php echo date("l g:i a", $currentTime); ?></div>
                        <div><?php echo date("jS F, Y",$currentTime); ?></div>
                        <div><?php echo ucwords($data->weather[0]->description); ?></div>
                    </div>
                    <div class="weather-forecast">
                        <img
                                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                                class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                                class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
                    </div>
                    <div class="time">
                        <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
                        <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
                    </div>
                </div>
            </div>
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
