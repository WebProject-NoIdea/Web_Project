<?php

include("session.php");
checkLogin();

if(isset($_POST['task']) AND $_POST['task']!=null){
    $task = $_POST['task'];
    $description = $_POST['description'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    include('dbconnect.php');

    $sql = "INSERT INTO task(user_id, task, description, start_date, end_date) VALUES (".getUserId().", '$task', '$description', '$startDate', '$endDate')";

    echo $sql;
    /*
    if ($conn->query($sql) === TRUE) {

    }*/

    $conn->close();
}
