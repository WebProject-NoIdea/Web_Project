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
        echo "<br>".print_r($row);
        calPerformance($row['start_date'],$row['end_date'],$row['complete_date']);
    }
}

$conn->close();

function updatePerformance($conn,$taskId,$performance){


    $sql = "UPDATE task
                SET performance=$performance
            WHERE task_id=$taskId AND user_id=".getUserId();

    if ($conn->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function calPerformance(String $startDate,String $endDate,String $completeDate){

    $timeStartDate  = strtotime($startDate);
    $timeEndDate = strtotime($endDate);
    $timeCompleteDate = strtotime($completeDate);
/*
    echo $startDate." - ".$timeStartDate."<br>".$endDate." - ".$timeEndDate."<br>".$completeDate." - ".$timeCompleteDate;
    echo "<br>";
    echo ($timeEndDate - $timeStartDate);
    echo "<br>";
    echo ($timeCompleteDate - $timeStartDate);
    echo "<br>";
    */
    return ($timeEndDate - $timeStartDate)/($timeCompleteDate - $timeStartDate)*100;


}