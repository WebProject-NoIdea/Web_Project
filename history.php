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

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <div id="main">
        <div class="inner">

            <div>
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
                                <h1>History</h1>
                                <p><strong>Activities</strong> that has been completed.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <?php include("task/taskTable.php");

            $conn = include("dbConnect.php");
                taskTable("history",$conn);
            $conn->close();

            include("task/viewTaskModal.php");
            include("task/editTaskModal.php");

            ?>

        </div>
    </div>

    <?php include('sidebar.php');?>

</div>


<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/transition.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>