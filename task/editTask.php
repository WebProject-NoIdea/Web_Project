<?php

include("../session.php");
checkLogin();

if(isset($_POST['taskId']) AND $_POST['taskId']!=null){
    $taskId = $_POST['taskId'];
    $task = $_POST['task'];
    $description = $_POST['description'];
    $startDate =  date_create($_POST['startDate']);
    $endDate = date_create($_POST['endDate']);

    include('../dbConnect.php');

    $sql = "UPDATE task
                SET task='$task',
                    description='$description',
                    start_date='".date_format($startDate,"Y-m-d H:i:s")."',
                    end_date='".date_format($endDate,"Y-m-d H:i:s")."'
            WHERE task_id=$taskId AND user_id=".getUserId();

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
