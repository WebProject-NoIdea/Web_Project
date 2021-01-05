<?php

include("../session.php");
checkLogin();

if(isset($_POST['task_id']) AND $_POST['task_id']!=null){
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $description = $_POST['description'];
    $startDate =  date_create($_POST['startDate']);
    $endDate = date_create($_POST['endDate']);

    include('../dbconnect.php');

    $sql = "UPDATE task
                SET task='$task',
                    description='$description',
                    start_date='".date_format($startDate,"Y-m-d H:i:s")."',
                    end_date='".date_format($endDate,"Y-m-d H:i:s")."'
            WHERE task_id=$task_id";

/*
    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
*/
    echo $sql;
    $conn->close();
}
