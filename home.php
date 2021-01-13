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

    <script src="vendor/jquery/2.2.4/jquery.min.js"></script>
    <script src="vendor/moment/2.13.0/moment.js"></script>
    <link href="vendor/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="vendor/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="vendor/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <script src="vendor/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

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

            <div class="page-heading">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10">
                            <h1>Performance</h1>
                            <h4 id="homeTitle" style="padding-left:10px; padding-bottom: 30px;"></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6" style="padding-bottom: 50px;">
                    <?php include("chart/donutChart.php"); ?>
                </div>

                <div class="col-md-6" style="padding-bottom: 50px;">
                    <?php include("chart/performanceChart.php"); ?>
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-bottom: 50px;">
                    <?php include("chart/performanceByDayChart.php"); ?>
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-bottom: 50px;">
                    <?php include("chart/statisticsByDayChart.php"); ?>
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label class="control-label" for="input-datepicker-start">Start Date</label>
                <div class="input-group" id="datepicker-start">
                    <input type="text" class="form-control" name="startDate" id="input-datepicker-start" autocomplete="off" required>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <script>
                // Linked date and time picker
                // start date date and time picker
                $('#datepicker-start').datetimepicker({
                    format:'yyyy MM',
                    widgetPositioning:{
                        horizontal: 'auto',
                        vertical: 'bottom'
                    }
                });
            </script>
        </div>
    </div>

    <?php include('sidebar.php');?>

</div>

<script>

    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;

    window.onload = function(){

        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        document.getElementById("homeTitle").innerHTML = year+" "+monthNames[month-1];

        showDoughnutChart(year,month);
        showPerformanceChart(year,month)
        showPerformanceByDayChart(year,month);
        showStatisticsByDayChart(year,month);
    }

</script>

<script type="text/javascript" src="vendor/canvasjs/canvasjs.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/transition.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>