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
                              <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
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
                                  <div class="form-group">
                                      <label for="startDate">Start Date</label>
                                      <input id="startDate" name="startDate" width="300" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="endDate">End Date</label>
                                      <input id="endDate" name="endDate" width="300" required>
                                  </div>

                                  <script>

                                      $('#startDate').datetimepicker({
                                          uiLibrary: 'bootstrap4',
                                          format: 'yyyy-mm-dd HH:MM',
                                          modal: true,
                                          footer: true
                                      });

                                      $('#endDate').datetimepicker({
                                          uiLibrary: 'bootstrap4',
                                          format: 'yyyy-mm-dd HH:MM',
                                          modal: true,
                                          footer: true
                                      });

                                  </script>

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                  <li>
                      <span class="opener"><i class = "fa fa-calendar"></i>  Task</span>
                      <ul>
                          <li><a href="#">Today</a></li>
                          <li><a href="#">This Week</a></li>
                          <li><a href="#">This Month</a></li>
                          <li><a href="#">Upcoming</a></li>
                      </ul>
                  </li>
                <li><a href="">History</a></li>
                <li><a href="">performance</a></li>

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

</body>
</html>
