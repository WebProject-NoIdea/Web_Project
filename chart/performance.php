<?php
class performance
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

        $jsonData = [
            'avgPerformance' => $this->avgPerformance(),
            'avgPerformancePerDay' => $this->avgPerformancePerDay()
        ];

        $this->conn->close();

        header('Content-type: text/javascript');
        echo json_encode($jsonData, JSON_PRETTY_PRINT);
    }

    private function avgPerformance(){
        $sql = "SELECT ROUND(AVG(performance),2) AS avgPerformance
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' AND user_id=" .getUserId();

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        return $row["avgPerformance"];
    }

    private function avgPerformancePerDay(): array
    {
        $year = $_GET['year'];
        $month = $_GET['month'];

        $sql = "SELECT DATE(complete_date) AS date, ROUND(AVG(performance),2) AS avgPerformance 
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' AND user_id=".getUserId()." AND MONTH(complete_date) = $month  AND YEAR(complete_date) = $year
                GROUP BY DATE(complete_date) 
                ORDER BY complete_date";

        $result = $this->conn->query($sql);

        $arrayData = array();

        while ($row = $result->fetch_assoc()) {
            array_push($arrayData, $row);
        }

        return $arrayData;
    }
}

(new performance())->run();

