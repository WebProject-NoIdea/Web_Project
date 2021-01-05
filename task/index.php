<?php

include("../session.php");
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
    <link rel="stylesheet" href="../vendor/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>StudLife: Home</title>

    <script src="../vendor/jquery/2.2.4/jquery.min.js"></script>
    <script src="../vendor/moment/2.13.0/moment.js"></script>
    <link href="../vendor/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../vendor/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="../vendor/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <script src="../vendor/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-style.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

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
                        <a href="../home.php">StudLife</a>
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

                <?php include("addTaskModal.php"); ?>
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
                                include('../dbconnect.php');

                                $sql = "SELECT * FROM task WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)<0 AND complete_date = '0000-00-00 00:00:00' ORDER BY end_date";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {

                                    include("editTaskModal.php");

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

                                                $date = date_format(date_create($row['end_date']),"D, d M Y h:i A");

                                                if(diffDateInSeconds($row['end_date'])<0){
                                                    echo "<tr style='background-color:#F1948A' id='tableToday_row_$i'>";
                                                }else{
                                                    echo "<tr id='tableToday_row_$i'>";
                                                }

                                                echo "    <td>#$i</td>
                                                            <td>".$row['task']."</td>
                                                            <td>".$row['description']."</td>
                                                            <td>$date</td>
                                                            <td>
                                                                <button class='btn' onclick='test(".json_encode($row).")'><i class='fa fa-check-square-o'></i></button>
                                                                <button class='btn' data-toggle='modal' data-target='#exampleModal"."Today".$row['task_id']."'><i class='fa fa-pencil'></i></button>
                                                
                                                            </td>
                                                        </tr>";

                                                //editModal("Today",$row);


                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                        <?php if($result->num_rows>5){?>

                                            <ul class="table-pagination">
                                                <li onclick="tableToday_prev(1)" id="tableToday_prevBtn"><a>Previous</a></li>
                                                <li onclick="tableToday_prev(2)"><a id="tableToday_btn1">1</a></li>
                                                <li onclick="tableToday_prev(1)"><a id="tableToday_btn2">2</a></li>
                                                <li class="active"><a id="tableToday_btn3">3</a></li>
                                                <li onclick="tableToday_next(1)"><a id="tableToday_btn4">4</a></li>
                                                <li onclick="tableToday_next(2)"><a id="tableToday_btn5">5</a></li>
                                                <li id="tableToday_moreBtn"><a>...</a></li>
                                                <li onclick="tableToday_next(1)" id="tableToday_nextBtn"><a>Next</a></li>
                                            </ul>

                                            <script>

                                                let tableToday_totalRow = <?php echo $result->num_rows; ?>;

                                                let tableToday_currentPage = 1;
                                                let tableToday_totalPage = Math.ceil(tableToday_totalRow/5);


                                                tableToday_showRow();


                                                function tableToday_prev(page){
                                                    tableToday_currentPage -= page;
                                                    tableToday_showRow();
                                                }

                                                function tableToday_next(page){
                                                    tableToday_currentPage += page;
                                                    tableToday_showRow();
                                                }

                                                function tableToday_showRow(){
                                                    tableToday_reset();

                                                    for (let i = (tableToday_currentPage*5)-4; i <= tableToday_currentPage*5; i++) {
                                                        document.getElementById('tableToday_row_' + i).style.display = 'table-row';
                                                        if(i===tableToday_totalRow){
                                                            break;
                                                        }
                                                    }

                                                    tableToday_reload();
                                                }

                                                function tableToday_reset(){
                                                    for (let i = 1; i <= tableToday_totalRow; i++) {
                                                        document.getElementById('tableToday_row_' + i).style.display = 'none';
                                                    }
                                                }

                                                function tableToday_reload() {
                                                    <!-- Previous Button -->
                                                    if ((tableToday_currentPage - 1) > 0) {
                                                        document.getElementById('tableToday_prevBtn').style.display = 'block';
                                                    } else {
                                                        document.getElementById('tableToday_prevBtn').style.display = 'none';
                                                    }

                                                    <!-- Number Button 1 -->
                                                    document.getElementById("tableToday_btn1").innerHTML = tableToday_currentPage - 2;
                                                    if ((tableToday_currentPage - 2) > 0) {
                                                        document.getElementById("tableToday_btn1").style.display = 'block';
                                                    } else {
                                                        document.getElementById("tableToday_btn1").style.display = 'none';
                                                    }

                                                    <!-- Number Button 2 -->
                                                    document.getElementById("tableToday_btn2").innerHTML = tableToday_currentPage - 1;
                                                    if ((tableToday_currentPage - 1) > 0) {
                                                        document.getElementById("tableToday_btn2").style.display = 'block';
                                                    } else {
                                                        document.getElementById("tableToday_btn2").style.display = 'none';
                                                    }

                                                    <!-- Number Button 3 -->
                                                    document.getElementById("tableToday_btn3").innerHTML = tableToday_currentPage;

                                                    <!-- Number Button 4 -->
                                                    document.getElementById("tableToday_btn4").innerHTML = tableToday_currentPage + 1;
                                                    if ((tableToday_currentPage + 1) <= tableToday_totalPage) {
                                                        document.getElementById('tableToday_btn4').style.display = 'block';
                                                    } else {
                                                        document.getElementById('tableToday_btn4').style.display = 'none';
                                                    }

                                                    <!-- Number Button 5 -->
                                                    document.getElementById("tableToday_btn5").innerHTML = tableToday_currentPage + 2;
                                                    if ((tableToday_currentPage + 2) <= tableToday_totalPage) {
                                                        document.getElementById('tableToday_btn5').style.display = 'block';
                                                    } else {
                                                        document.getElementById('tableToday_btn5').style.display = 'none';
                                                    }

                                                    <!-- More Button -->
                                                    if ((tableToday_currentPage + 3) <= tableToday_totalPage) {
                                                        document.getElementById('tableToday_moreBtn').style.display = 'block';
                                                    } else {
                                                        document.getElementById('tableToday_moreBtn').style.display = 'none';
                                                    }

                                                    <!-- Next Button -->
                                                    if (tableToday_totalPage > 1 && tableToday_currentPage !== tableToday_totalPage) {
                                                        document.getElementById('tableToday_nextBtn').style.display = 'block';
                                                    } else {
                                                        document.getElementById('tableToday_nextBtn').style.display = 'none';
                                                    }
                                                }
                                            </script>
                                        <?php }?>

                                        <script>
                                            function test(row){
                                                console.log(row);
                                            }
                                        </script>

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

                                include('../dbconnect.php');

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

    <?php include('../sidebar.php');?>

</div>


<script src="../assets/js/browser.min.js"></script>
<script src="../assets/js/breakpoints.min.js"></script>
<script src="../assets/js/transition.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/custom.js"></script>

</body>
</html>