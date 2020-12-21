<?php

$dbServername = "localhost";
$dbUsername = "u198522155_web_project";
$dbPassword = "8:HFMa0:o";
$dbDatabase = "u198522155_web_project";

// Create connection
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbDatabase);

// Check connection
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}
?>