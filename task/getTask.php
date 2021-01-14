<?php
class getTask{

    public function __construct()
    {
        include("../session.php");
        checkLogin();
    }

    public function run()
    {
        $conn = include('../dbConnect.php');

        $type = $_GET['type'];

        if($type!="") {
            switch ($type) {
                case "today":
                    $sql = "SELECT task_id, task, description, start_date, end_date
                    FROM task 
                    WHERE user_id=" . getUserId() . " AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)<0 AND complete_date = '0000-00-00 00:00:00' 
                    ORDER BY end_date";
                    break;
                case "upcoming":
                    $sql = "SELECT task_id, task, description, start_date, end_date
                    FROM task 
                    WHERE user_id=" . getUserId() . " AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)>0 AND complete_date = '0000-00-00 00:00:00' 
                    ORDER BY start_date";
                    break;

                case "history":
                    $sql = "SELECT task_id, task, description, start_date, end_date, complete_date,performance
                    FROM task 
                    WHERE user_id=" . getUserId() . " AND complete_date != '0000-00-00 00:00:00' 
                    ORDER BY complete_date DESC";
                    break;
                default:
                    $sql = "";
            }

            $result = $conn->query($sql);

            $arrayData = array();

            while ($row = $result->fetch_assoc()) {
                array_push($arrayData, $row);
            }

            header('Content-type: text/javascript');
            echo json_encode($arrayData, JSON_PRETTY_PRINT);
        }
    }
}
(new getTask())->run();