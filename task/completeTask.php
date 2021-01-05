<?php

include("../session.php");
checkLogin();

if(isset($_POST['taskId']) AND $_POST['taskId']!=null){
    $taskId = $_POST['taskId'];
    $completeDate = date_create($_POST['completeDate']);

    $conn = include('../dbConnect.php');

    $sql = "UPDATE task
                SET complete_date='".date_format($completeDate,"Y-m-d H:i:s")."'
            WHERE task_id=$taskId AND user_id=".getUserId();

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
