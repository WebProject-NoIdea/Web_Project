<?php

include("../session.php");
checkLogin();

$conn = include('../dbConnect.php');

$sql = "SELECT task_id, task, description, start_date, end_date, complete_date
                    FROM task 
                    WHERE user_id=".getUserId()." AND complete_date != '0000-00-00 00:00:00' 
                    ORDER BY complete_date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo print_r($row);
    }
}

$conn->close();

function updatePerformance($conn,$taskId){

/*
    $sql = "UPDATE task
                SET performance=
            WHERE task_id=$taskId AND user_id=".getUserId();

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    */
}