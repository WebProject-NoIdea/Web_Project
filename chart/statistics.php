<?php
class statistics
{
    private $conn;

    public function __construct()
    {
        include("../session.php");
        checkLogin();
    }

    public function run()
    {
        $this->conn = include('../dbConnect.php');

        $year = $_GET['year'];
        $month = $_GET['month'];

        $jsonData = [
            'statistics' => $this->statistics($year, $month),
            'statisticsPerDay' => $this->statisticsPerDay($year, $month)
        ];

        $this->conn->close();

        header('Content-type: text/javascript');
        echo json_encode($jsonData, JSON_PRETTY_PRINT);
    }

    private function statistics($year, $month)
    {
        $startDate = date("Y-m-d", strtotime($year . "-" . $month));

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $today = date("Y-m-d");

        $sql = "SELECT 
                    COUNT(CASE WHEN complete_date != '0000-00-00 00:00:00' AND complete_date<=end_date THEN 1 END) AS completed,
                    COUNT(CASE WHEN complete_date != '0000-00-00 00:00:00' AND complete_date>end_date THEN 1 END) AS overdue,
                    COUNT(CASE WHEN complete_date = '0000-00-00 00:00:00' THEN 1 END) AS in_progress
                 FROM task 
                 WHERE user_id=".getUserId()."
                    AND DATE(start_date)<='$today'
                    AND (complete_date='0000-00-00 00:00:00' OR DATE(complete_date)>='$startDate')";

        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    private function statisticsPerDay($year, $month): array
    {
        $arrayData = array();

        $startDate = date("Y-m-d", strtotime($year . "-" . $month));
        $lastDate = date("t", $startDate);

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $today = date("Y-m-d");

        for ($i = 0; $i < $lastDate; $i++) {

            $endDate = date('Y-m-d', strtotime($startDate . " + $i days"));

            if ($endDate > $today) {
                break;
            }

            $sql = "SELECT 
                        '$endDate' AS date,
                        COUNT(CASE WHEN complete_date != '0000-00-00 00:00:00' AND complete_date<=end_date AND DATE(complete_date)<='$endDate' THEN 1 END) AS completed,
                        COUNT(CASE WHEN complete_date != '0000-00-00 00:00:00' AND complete_date>end_date AND DATE(complete_date)<='$endDate' THEN 1 END) AS overdue,
                        COUNT(CASE WHEN complete_date = '0000-00-00 00:00:00'  OR DATE(complete_date)>'$endDate' THEN 1 END) AS in_progress
                     FROM task 
                     WHERE user_id=".getUserId()." 
                        AND DATE(start_date)<='$endDate' 
                        AND (complete_date='0000-00-00 00:00:00' OR DATE(complete_date)>='$startDate')";

            $result = $this->conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                array_push($arrayData, $row);
            }
        }

        return $arrayData;
    }
}

(new statistics())->run();