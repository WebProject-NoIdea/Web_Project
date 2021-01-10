<?php

include("../session.php");
checkLogin();

$conn = include('../dbConnect.php');

$sql = "SELECT task_id, task, description, start_date, end_date, complete_date,performance
                    FROM task 
                    WHERE user_id=".getUserId()." AND complete_date != '0000-00-00 00:00:00' 
                    ORDER BY complete_date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<br>".print_r($row);
        echo calPerformance($row['start_date'],$row['end_date'],$row['complete_date']);
        updatePerformance($conn,$row['task_id'],calPerformance($row['start_date'],$row['end_date'],$row['complete_date']));
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
    $targetTime = $timeEndDate - $timeStartDate;
    $usedTime = $timeCompleteDate - $timeStartDate;

    if($usedTime>$targetTime){
        $performance = round(100-(($usedTime-$targetTime)/$targetTime*100),2);
    }else{
        $performance = round(200-($usedTime/$targetTime*100),2);
    }

    if($performance<0){
        $performance = 0;
    }

    return $performance;
}