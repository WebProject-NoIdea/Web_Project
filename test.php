<?php
include "dbConnect.php";

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}else{
    echo "Connected to MySQL";
    exit();
}

?>