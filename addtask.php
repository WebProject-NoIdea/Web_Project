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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <!--
    Ramayana CSS Template
    https://templatemo.com/tm-529-ramayana
    -->

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
                        <div class="col-md-12">
                            <h1>Add Task</h1>
                            <p><strong>Activities</strong> that need to be done .</p>
                        </div>
                    </div>
                </div>
            </div>


                        <form>

                                <div class="form-group">
                                    <label for="task">Task</label>
                                    <input type="text" class="form-control" id="task" name="task" placeholder="Task">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                                </div>
                                <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input id="startDate" name="startDate" width="300">
                                </div>
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input id="endDate" name="endDate" width="300">
                                </div>

                                <script>
                                    $('#startDate').datetimepicker({
                                        uiLibrary: 'bootstrap4',
                                        modal: true,
                                        footer: true
                                    });

                                    $('#endDate').datetimepicker({
                                        uiLibrary: 'bootstrap4',
                                        modal: true,
                                        footer: true
                                    });
                                </script>


                                <button type="button" class="btn btn-primary">Save changes</button>

                        </form>






        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar">

        <div class="inner">

            <!-- Search Box -->
            <section id="search" class="alt">
                <form method="get" action="#">
                    <input type="text" name="search" id="search" placeholder="Search..." />
                </form>
            </section>

            <!-- Menu -->
            <nav id="menu">
                <ul>
                    <li><a href="home.php">Homepage</a></li>
                    <li><a href="today.html">Today</a></li>
                    <li><a href="upcoming.html">Upcoming</a></li>
                    <li>
                        <span class="opener"><i class = "fa fa-calendar"></i>  Task</span>
                        <ul>
                            <li><a href="#">Today</a></li>
                            <li><a href="#">This Week</a></li>
                            <li><a href="#">This Month</a></li>
                            <li><a href="#">Upcoming</a></li>
                        </ul>
                    </li>
                    <li>
                        <span class="opener"><i class = "fa fa-bookmark"></i>  Work Label</span>
                        <ul>
                            <li><a href="#">Oppointments</a></li>
                            <li><a href="#">Phone Call</a></li>
                            <li><a href="#">Meeting</a></li>
                            <li><a href="#">+</a></li>
                        </ul>
                    </li>
                    <li>
                        <span class="opener"><i class = "fa fa-bookmark-o"></i>  Leisure Label</span>
                        <ul>
                            <li><a href="#">Entertaiment</a></li>
                            <li><a href="#">Holiday</a></li>
                            <li><a href="#">+</a></li>

                        </ul>
                    </li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure you want to sign out?')">Sign Out</a></li>
                </ul>
            </nav>



            <!-- Footer -->
            <footer id="footer">
                <p class="setting">
                    <i class = "fa fa-cog"></i>  <a rel="Setting" href="setting.html">Setting</a></p>
            </footer>

        </div>
    </div>

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

<script type="text/javascript" src="vendor/canvasjs/canvasjs.min.js"></script>

</body>
</html>
