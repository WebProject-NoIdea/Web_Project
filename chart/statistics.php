<?php

include("../session.php");
checkLogin();

$conn = include('../dbConnect.php');

$sql = "SELECT 
            COUNT(CASE WHEN complete_date != '0000-00-00 00:00:00' AND complete_date<=end_date THEN 1 END) AS completed,
            COUNT(CASE WHEN complete_date != '0000-00-00 00:00:00' AND complete_date>end_date THEN 1 END) AS overdue,
            COUNT(CASE WHEN complete_date = '0000-00-00 00:00:00' THEN 1 END) AS in_progess
         FROM task WHERE user_id=".getUserId();

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo json_encode($row);
}

$conn->close();