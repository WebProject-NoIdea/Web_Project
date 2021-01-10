<?php

function updatePerformance($conn,$taskId){
    $sql = "SELECT start_date, end_date, complete_date
                    FROM task 
                    WHERE task_id=$taskId AND user_id=".getUserId();

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            updateDatabase($conn,$taskId,calPerformance($row['start_date'],$row['end_date'],$row['complete_date']));
        }
    }

    function updateDatabase($conn,$taskId,$performance){

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
}
