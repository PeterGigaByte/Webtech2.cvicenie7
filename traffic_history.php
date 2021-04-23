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
include_once "api/history.php";
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
                    <?php
                    $count = 0;
                    foreach($country_visits as $country_visit){
                        $img = strtolower($country_visit[2]);
                        $imgPath = "http://www.geonames.org/flags/x/$img.gif";
                        $img = "<img style='width: 20px;height: auto' src='$imgPath'>";
                        echo "<tr><td class='country' >$country_visit[1] $img</td>";
                        echo "<td>$country_visit[0]</td></tr>";
                        $count=$country_visit[0]+$count;
                    }
                    echo "<tr><td>Spolu</td>";
                    echo "<td>$count</td></tr>";
                    ?>
                </tbody>
            </table>
        </div>
        <script>
            $(".country").click(function (){
                let country = $(this).text();
                let modal = new jBox('Modal', {
                    attach: '#Modal',
                    width: 600,
                    height: 500,
                    blockScroll: true,
                    animation: 'zoomIn',
                    draggable: 'title',
                    closeButton: true,
                    overlay: false,
                    reposition: false,
                    repositionOnOpen: false
                }).open();
                $.ajax({
                    type : "GET",
                    url : "https://wt130.fei.stuba.sk/cvicenia/cvicenie7/api/country.php?country="+country,
                    success: function(result){
                        modal.setContent(result);
                    },
                    error : function(e) {
                        new jBox('Notice', {
                            animation: 'flip',
                            color: 'red',
                            content: 'Neúspech !!',
                            delayOnHover: true,
                            showCountdown: true
                        });
                        console.log(e)
                    }
                });

            });
    </script>
        <div style="height: 30px"></div>
        <div class="row">
            <table id="table2">
                <thead>
                <tr style="background-color: #1F2739">
                    <th colspan="2">Návštevy stránok</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($sites_visits as $site_visit){
                    echo "<tr><td>$site_visit[1]</td>";
                    echo "<td>$site_visit[0]</td></tr>";
                }
                ?>
                    </tbody>
                </table>
            </div>
        <div style="height: 30px"></div>
        <div class="row">
            <table id="table3">
                <thead>
                <tr style="background-color: #1F2739">
                    <td colspan="2">Návštevy počas dňa</td>
                </tr>
                </thead>
                <tbody>
                <?php
                 ;
                    echo "<tr><td>6:00-15:00</td>";
                    echo "<td>$morning_visits</td></tr>";
                    echo "<tr><td>15:00-21:00</td>";
                    echo "<td>$lunch_visits</td></tr>";
                    echo "<tr><td>21:00-21:00</td>";
                    echo "<td>$evening_visits</td></tr>";
                    echo "<tr><td>24:00-6:00</td>";
                    echo "<td>$night_visits</td></tr>";
                ?>
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
