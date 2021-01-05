<?php

include("../session.php");
checkLogin();

if(isset($_POST['taskId']) AND $_POST['taskId']!=null){
    $taskId = $_POST['taskId'];

    include('../dbconnect.php');

    $sql = "DELETE FROM task
            WHERE task_id=$taskId AND user_id=".getUserId();

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
