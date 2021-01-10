<?php

include("session.php");
checkLogin();


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="vendor/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>StudLife: Home</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <div id="main">
        <div class="inner">

            <!-- Header -->
            <header id="header">
                <div class="logo">
                    <a href="home.php">StudLife</a>
                </div>
            </header>

            <!-- Banner -->
            <section class="main-banner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="banner-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">
                                            <h4>Hello, welcome to <em>StudLife</em>. </h4>
                                            <span>StudLife Makes Your Student Life Easier</span>
                                            <p>StudLife is a DashBoard System which designed and developed specially for University Student. StudLife helps student to manage their daily task such as assignment, meeting or even an event. We hope that by using StudLife, you will be able to keep track of your task better and be more productive as a student. </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- Daily -->
            <section class="top-image">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="down-content">
                                <h4>Your Task Completed in last 7 days</h4>
                                <img src="assets/images/daily.png" alt="">
                                <!--<div class="chart">
                                <div id="chartContainer1" style="height: 300px; width: 80%;"></div>-->
                            </div>
                            <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.</p>

                        </div>
                    </div>
                </div>

            </section>

            <!-- Weekly -->
            <section class="top-image">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="down-content">
                                <h4>Your Task Completed in last 4 weeks</h4>
                                <img src="assets/images/weekly.png" alt="">
                                <!--<div class="chart">
                                <div id="chartContainer1" style="height: 300px; width: 80%;"></div>-->
                            </div>
                            <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.</p>

                        </div>
                    </div>
                </div>

            </section>

            <!-- Monthly -->
            <section class="top-image">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="down-content">
                                <h4>Your Task Completed</h4>
                                <div class="chart">
                                    <div id="chartContainer3" style="height: 300px; width: 80%;">
                                    </div></div>
                                <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <?php include('sidebar.php');?>

</div>

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/transition.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/custom.js"></script>

<script type="text/javascript">
    //monthly
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer3",
            {

                title:{
                    text: "Performance - per month"
                },
                data: [
                    {
                        type: "line",

                        dataPoints: [
                            { x: new Date(2012, 00, 1), y: 450 },
                            { x: new Date(2012, 01, 1), y: 414 },
                            { x: new Date(2012, 02, 1), y: 520 },
                            { x: new Date(2012, 03, 1), y: 460 },
                            { x: new Date(2012, 04, 1), y: 450 },
                            { x: new Date(2012, 05, 1), y: 500 },
                            { x: new Date(2012, 06, 1), y: 480 },
                            { x: new Date(2012, 07, 1), y: 480 },
                            { x: new Date(2012, 08, 1), y: 410 },
        { x: new Date(2012, 09, 1), y: 500 },
        { x: new Date(2012, 10, 1), y: 480 },
        { x: new Date(2012, 11, 1), y: 510 }
    ]
    }
    ]
    });

        chart.render();
    }
</script>
<script type="text/javascript" src="vendor/canvasjs/canvasjs.min.js"></script>

</body>
</html>
