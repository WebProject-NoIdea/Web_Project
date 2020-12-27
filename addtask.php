<?php

include("session.php");
checkLogin();

if(isset($_POST['task']) AND $_POST['task']!=null){
    $task = $_POST['task'];
    $task = $_POST['description'];
    $task = $_POST['startDate'];
    $task = $_POST['endDate'];

    include('dbconnect.php');

    $sql = "INSERT INTO user (email, password, firstname, lastname) VALUES ('$email', '$password', '$firstName', '$lastName')";

    echo $sql;
    /*
    if ($conn->query($sql) === TRUE) {

    }*/

    $conn->close();
}
