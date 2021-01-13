<?php
class earliestDate
{

    public function __construct()
    {
        include("../session.php");
        checkLogin();
    }

    public function run()
    {
        $conn = include('../dbConnect.php');

        $sql = "SELECT `start_date` FROM `task` WHERE user_id = ".getUserId()." ORDER BY start_date LIMIT 1";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        $conn->close();

        header('Content-type: text/javascript');
        echo json_encode($row, JSON_PRETTY_PRINT);
    }
}
(new earliestDate())->run();