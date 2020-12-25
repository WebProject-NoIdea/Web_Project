<?php

if(isset($_POST['submit'])){
    header( "Location: home.html" );
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="vendor/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    body {
      background-image: url('assets/images/top-image.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
</head>
<body>

<!-- partial:index.partial.html -->
<div
  class="form"
  style="
    position: absolute;
    top: 50%;
    left: 50%;
    width: 600px;
    transform: translate(-50%, -50%);">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Log In</a></li>
        <li class="tab"><a href="#signup">Sign Up</a></li>
      </ul>
      
      <div class="tab-content">

        <div id="login">   
          <h1>Welcome!</h1>
          
          <form method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button type="submit" class="button button-block">Log In</button>
          
          </form>

        </div>

        <div id="signup">
          <h1>Sign Up for Free</h1>

          <form action="/" method="post">

            <div class="top-row">
              <div class="field-wrap">
                <label>
                  First Name<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" />
              </div>

              <div class="field-wrap">
                <label>
                  Last Name<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off"/>
              </div>
            </div>

            <div class="field-wrap">
              <label>
                Email Address<span class="req">*</span>
              </label>
              <input type="email" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <label>
                Set A Password<span class="req">*</span>
              </label>
              <input type="password" required autocomplete="off"/>
            </div>

            <button type="submit" class="button button-block">Get Started</button>

          </form>

        </div>
      </div>
</div>
  <script src='vendor/jquery/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
</body>
</html>
