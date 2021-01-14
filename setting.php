<?php

include("session.php");
checkLogin();


if(isset($_POST['changeName'])){

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $conn = include('dbConnect.php');

    $sql = "UPDATE user SET firstname = '$firstName', lastname = '$lastName' WHERE user_id=".getUserId();

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}else if(isset($_POST['changePassword'])){

    $password = encrypt($_POST['oldPassword']);
    $newPassword1 = encrypt($_POST['newPassword1']);
    $newPassword2 = encrypt($_POST['newPassword2']);

    if($newPassword1!=$newPassword2){
        echo '<script>alert("New password and Confirm new password not same !")</script>';
    }else{

        $conn = include('dbConnect.php');

        $sql = "SELECT user_id FROM user WHERE user_id=".getUserId()." AND password='$password'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql2 = "UPDATE user SET password = '$newPassword1' WHERE user_id=".getUserId();

            if ($conn->query($sql2) === false) {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }else{
                logout();
            }

        }else{
            echo '<script>alert("Wrong password !")</script>';
        }

        $conn->close();
    }
}

function encrypt(String $password){
    $pwd64 = base64_encode($password);
    return md5($pwd64);
}

$conn = include('dbConnect.php');

$sql = "SELECT firstname, lastname, email FROM user WHERE user_id=".getUserId();

$result = $conn->query($sql);

$name = "";
$email = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['lastname']." ".$row['firstname'];
        $email = $row['email'];
    }
}

$conn->close();

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
                            <h1><?php echo $name; ?></h1>
                            <p><?php echo $email; ?></p>
                        </div>
                        <div class="col-md-2">
                            <!-- Button trigger modal -->
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add Task
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="tables" style="padding-top: 20px">
                <div class="row">
                    <div class="col-md-6">
                        <br><h3><b>Change Name</b></h3><br>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                            </div>

                            <button type="submit" name="changeName" class="btn btn-primary">Change Name</button>
                        </form>

                        <br><br><h3><b>Change Password</b></h3><br>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="oldPassword">Old Password</label>
                                <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Old Password" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword1">New Password</label>
                                <input type="password" class="form-control" name="newPassword1" id="newPassword1" placeholder="New Password" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword2">Confirm New Password</label>
                                <input type="password" class="form-control" name="newPassword2" id="newPassword2" placeholder="Confirm New Password" minlength="8"  required>
                            </div>
                            <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </section>

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