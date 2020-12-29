<?php

include("session.php");
checkLogin();

date_default_timezone_set("Asia/Kuala_Lumpur");

function diffDateInSeconds(String $datetime){
    $timeFirst  = time();
    $timeSecond = strtotime($datetime);
    return $timeSecond - $timeFirst;
}
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
    <link href="vendor/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>


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

            <div id="addtask">
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
                                <h1>Task</h1>
                                <p><strong>Activities</strong> that need to be done .</p>
                            </div>
                            <div class="col-md-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> Add Task
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Task</h4>
                            </div>
                            <form id="addTaskForm">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="task">Task</label>
                                        <input type="text" class="form-control" id="task" name="task" placeholder="Task" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="input-datepicker-start">Start Date</label>
                                            <div class="input-group" id="datepicker-start">
                                                <input type="text" class="form-control" id="input-datepicker-start">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="input-datepicker-end">End Date</label>
                                            <div class="input-group" id="datepicker-end">
                                                <input type="text" class="form-control" id="input-datepicker-end">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        // Linked date and time picker
                                        // start date date and time picker
                                        $('#datepicker-start').datetimepicker();

                                        // End date date and time picker
                                        $('#datepicker-end').datetimepicker({
                                            useCurrent: false
                                        });

                                        // start date picke on chagne event [select minimun date for end date datepicker]
                                        $("#datepicker-start").on("dp.change", function (e) {
                                            $('#datepicker-end').data("DateTimePicker").minDate(e.date);
                                        });
                                        // Start date picke on chagne event [select maxmimum date for start date datepicker]
                                        $("#datepicker-end").on("dp.change", function (e) {
                                            $('#datepicker-start').data("DateTimePicker").maxDate(e.date);
                                        });
                                    </script>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submitBtn" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>

                            <script>
                                const addTaskForm = document.getElementById("addTaskForm");

                                addTaskForm.addEventListener('submit',function (e){
                                    e.preventDefault();

                                    document.getElementById("submitBtn").disabled = true;
                                    document.getElementById("submitBtn").innerHTML = "Saving ...";

                                    const formData = new FormData(this);

                                    fetch('addtask.php',{
                                        method: 'post',
                                        body: formData
                                    }).then(response => {
                                        console.log(response.text());
                                        if(response.ok){
                                            location.reload();
                                        }
                                    }).catch(error => {
                                        console.log(error);
                                    });
                                });

                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div id="today">
                <!-- Tables -->
                <section class="tables">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-heading">
                                    <h2>Today</h2>
                                </div>

                                <?php
                                include('dbconnect.php');

                                $sql = "SELECT * FROM task WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)<0 AND complete_date = '0000-00-00 00:00:00' ORDER BY end_date";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {

                                    ?>

                                    <div class="default-table">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Task</th>
                                                <th>Description</th>
                                                <th>End Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $i = 1;

                                            while ($row = $result->fetch_assoc()) {

                                                $date = date_format(date_create($row['end_date']),"d M Y h:i A");

                                                if(diffDateInSeconds($row['end_date'])<0){
                                                    echo '<tr style="background-color:#F1948A">';
                                                }else{
                                                    echo "<tr>";
                                                }

                                                echo "    <td>#$i</td>
                                                            <td>".$row['task']."</td>
                                                            <td>".$row['description']."</td>
                                                            <td>$date</td>
                                                        </tr>";

                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <ul class="table-pagination">
                                            <li><a href="#">Previous</a></li>
                                            <li><a href="#">1</a></li>
                                            <li class="active"><a href="#">2</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#">8</a></li>
                                            <li><a href="#">9</a></li>
                                            <li><a href="#">Next</a></li>
                                        </ul>
                                    </div>
                                    <?php
                                }else{
                                    echo "No Task";
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div id="upcoming">
                <!-- Tables -->
                <section class="tables" style="margin-top: 0;border-top: 0 !important;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-heading">
                                    <h2>Upcoming</h2>
                                </div>

                                <?php

                                include('dbconnect.php');

                                $sql = "SELECT * FROM task WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)>0 AND complete_date = '0000-00-00 00:00:00' ORDER BY start_date";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {

                                    ?>

                                    <div class="default-table">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Task</th>
                                                <th>Description</th>
                                                <th>Start Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $i = 1;

                                            while ($row = $result->fetch_assoc()) {
                                                $date = date_format(date_create($row['start_date']),"d M Y h:i A");

                                                echo "<tr>
                                                            <td>#$i</td>
                                                            <td>".$row['task']."</td>
                                                            <td>".$row['description']."</td>
                                                            <td>$date</td>
                                                        </tr>";

                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <ul class="table-pagination">
                                            <li><a href="#">Previous</a></li>
                                            <li><a href="#">1</a></li>
                                            <li class="active"><a href="#">2</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#">8</a></li>
                                            <li><a href="#">9</a></li>
                                            <li><a href="#">Next</a></li>
                                        </ul>
                                    </div>
                                    <?php
                                }else{
                                    echo "No Task";
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php include('sidebar.php');?>

</div>

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/transition.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>