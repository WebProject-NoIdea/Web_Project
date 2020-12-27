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

                              $sql = "SELECT * FROM task WHERE user_id=".getUserId();

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


              <!-- Tables -->
              <section class="tables" style="margin-top: 0;border-top: 0 !important;">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="section-heading">
                                  <h2>Upcoming</h2>
                              </div>
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
                                          <tr>
                                              <td>#1</td>
                                              <td> Do registration screen</td>
                                              <td>page for registration</td>
                                              <td>
                                                  <button class="btn"><i class="fa fa-trash"></i></button>
                                                  <button class="btn"><i class="fa fa-pencil"></i></button>

                                              </td>
                                              <br>

                                          </tr>

                                          <tr>
                                              <br>
                                          </tr>
                                          <tr></tr>
                                          <tr></tr>
                                          <tr></tr>
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
                          </div>
                      </div>
                  </div>
              </section>







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
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In eu mi bibendum neque egestas congue quisque egestas diam. Urna duis convallis convallis tellus id interdum velit laoreet. Felis bibendum ut tristique et egestas quis ipsum suspendisse ultrices. Amet nisl suscipit adipiscing bibendum est ultricies integer quis. </p>
                            
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
            </section>

            <!-- Services 
          <section class="services">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-4">
                    <div class="service-item first-item">
                      <div class="icon"></div>
                      <h4>Web Design</h4>
                      <p>Credit goes to <a rel="nofollow" href="https://www.pexels.com">Pexels</a> and <a rel="nofollow" href="https://www.rawpixel.com">Raw Pixel</a> for images used in this template. Thank you.</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="service-item second-item">
                      <div class="icon"></div>
                      <h4>Bootstrap 4</h4>
                      <p>Proin aliquam facilisis ante interdum. Sed nulla feugiat tempus aliquam.</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="service-item third-item">
                      <div class="icon"></div>
                      <h4>HTML CSS</h4>
                      <p>Proin aliquam facilisis ante interdum. Sed nulla feugiat tempus aliquam.</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="service-item fourth-item">
                      <div class="icon"></div>
                      <h4>Download Free</h4>
                      <p>We have many free to use CSS web templates on our site for you.</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="service-item fivth-item">
                      <div class="icon"></div>
                      <h4>Get in touch</h4>
                      <p>You can get the fastest response from <a rel="nofollow" href="https://www.facebook.com/templatemo">templatemo</a> facebook page.</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="service-item sixth-item">
                      <div class="icon"></div>
                      <h4>Spread a word</h4>
                      <p>Please tell your friends about our website. This is very helpful.</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>-->

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


            <!-- Left Image 
            <section class="left-image">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/left-image.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <div class="right-content">
                      <h4>Ante Interdum Raclette</h4>
                      <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.<br><br>Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put bird brooklyn</p>
                      <div class="primary-button">
                        <a href="#">Read More</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>-->

            <!-- Right Image 
            <section class="right-image">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <div class="left-content">
                      <h4>Ante Interdum Raclette</h4>
                      <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.<br><br>Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put bird brooklyn</p>
                      <div class="primary-button">
                        <a href="#">Read More</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <img src="assets/images/right-image.jpg" alt="">
                  </div>
                </div>
              </div>
            </section>-->

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
