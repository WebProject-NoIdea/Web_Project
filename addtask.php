<?php

include("session.php");
checkLogin();

if(isset($_POST['task']) AND $_POST['task']!=null){
    $task = $_POST['task'];
    $description = $_POST['description'];
    $startDate =  date_create($_POST['startDate']);
    $endDate = date_create($_POST['endDate']);

    include('dbconnect.php');

    $sql = "INSERT INTO task(user_id, task, description, start_date, end_date) VALUES (".getUserId().", '$task', '$description', '".date_format($startDate,"Y-m-d H:i:s")."', '".date_format($endDate,"Y-m-d H:i:s")."')";

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
