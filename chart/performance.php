<?php

include("../session.php");
checkLogin();

$conn = include('../dbConnect.php');

$sql = "SELECT AVG(performance) AS avgPerformance
         FROM task WHERE user_id=" . getUserId();

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo json_encode(round($row["avgPerformance"],2));
}

$conn->close();