<?php

session_start();

if($_SESSION['webProjectLoggedIn']){
    header( "Location: home.php" );
}

if(isset($_POST['login'])){

    $email = $_POST['loginEmail'];
    $password = encrypt($_POST['loginPassword']);

    $conn = include('dbConnect.php');

    $sql = "SELECT user_id FROM user WHERE email='$email' and password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["webProjectLoggedIn"] = true;
            $_SESSION["webProjectUserId"] = $row['user_id'];
            header( "Location: home.php");
        }
    }else{
        echo '<script>alert("Wrong email or password !")</script>';
    }

    $conn->close();

}else if(isset($_POST['signUp'])){
    $firstName = $_POST['signUpFirstName'];
    $lastName = $_POST['signUpLastName'];
    $email = $_POST['signUpEmail'];
    $password = encrypt($_POST['signUpPassword']);

    $conn = include('dbConnect.php');

    $sql = "SELECT user_id FROM user WHERE email='$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<script>alert("This email address already exists !")</script>';
    }else{
        $sql = "INSERT INTO user (email, password, firstname, lastname) VALUES ('$email', '$password', '$firstName', '$lastName')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Congratulations, your account has been successfully created.");
                            window.location.href="index.php";</script>';
        }
    }

    $conn->close();
}

function encrypt(String $password){
    $pwd64 = base64_encode($password);
    return md5($pwd64);
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>StudLife - Sign-Up or Login </title>
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
 <div class="title">
     <img src="assets/images/logo.png" alt="logo"
    </div>
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
          <h1>Welcome to StudLife!</h1>

            <form action="" method="post">

              <div class="field-wrap">
                <label>
                  Email Address<span class="req">*</span>
                </label>
                <input type="email" name="loginEmail" required autocomplete="off"/>
              </div>

              <div class="field-wrap">
                <label>
                  Password<span class="req">*</span>
                </label>
                <input type="password" name="loginPassword" minlength="8" required autocomplete="off"/>
              </div>

              <p class="forgot"><a href="#">Forgot Password?</a></p>
              <button type="submit" name="login" class="button button-block">Log In</button>

          </form>
        </div>

        <div id="signup">
          <h1>Sign Up for Free</h1>

          <form action="" method="post">

            <div class="top-row">
              <div class="field-wrap">
                <label>
                  First Name<span class="req">*</span>
                </label>
                <input type="text" name="signUpFirstName" required autocomplete="off" />
              </div>

              <div class="field-wrap">
                <label>
                  Last Name<span class="req">*</span>
                </label>
                <input type="text" name="signUpLastName" required autocomplete="off"/>
              </div>
            </div>

            <div class="field-wrap">
              <label>
                Email Address<span class="req">*</span>
              </label>
              <input type="email" name="signUpEmail" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <label>
                Set A Password<span class="req">*</span>
              </label>
              <input type="password" name="signUpPassword" minlength="8" required autocomplete="off"/>
            </div>

            <button type="submit" name="signUp" class="button button-block">Get Started</button>

          </form>

        </div>
      </div>
</div>
  <script src='vendor/jquery/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
</body>
</html>
