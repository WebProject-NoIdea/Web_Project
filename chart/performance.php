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

        $year = $_GET['year'];
        $month = $_GET['month'];

        $jsonData = [
            'avgPerformance' => $this->avgPerformance($year,$month),
            'avgPerformancePerDay' => $this->avgPerformancePerDay($year,$month)
        ];

        $this->conn->close();

        header('Content-type: text/javascript');
        echo json_encode($jsonData, JSON_PRETTY_PRINT);
    }

    private function avgPerformance($year,$month){
        $sql = "SELECT ROUND(AVG(performance),2) AS avgPerformance
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' 
                  AND user_id=" .getUserId()."
                  AND MONTH(complete_date) = $month 
                  AND YEAR(complete_date) = $year";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        return $row["avgPerformance"];
    }

  /*  private function avgPerformancePerDay($year,$month): array
    {
        $sql = "SELECT DATE(complete_date) AS date, ROUND(AVG(performance),2) AS avgPerformance 
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' 
                  AND user_id=".getUserId()." 
                  AND MONTH(complete_date) = $month 
                  AND YEAR(complete_date) = $year
                GROUP BY DATE(complete_date) 
                ORDER BY complete_date";

        $result = $this->conn->query($sql);

        $arrayData = array();

        while ($row = $result->fetch_assoc()) {
            array_push($arrayData, $row);
        }

        return $arrayData;
    }*/

    private function avgPerformancePerDay($year,$month): array
    {
        $arrayData = array();

        $startDate = date("Y-m-d",strtotime($year."-".$month));
        $lastDate = date("t",$startDate);

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $today = date("Y-m-d");

        for($i=0; $i<$lastDate; $i++) {

            $endDate = date('Y-m-d', strtotime($startDate. " + $i days"));

            if($endDate>$today){
                break;
            }

            $sql = "SELECT '$endDate' AS date, ROUND(AVG(performance),2) AS avgPerformance 
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' 
                  AND user_id=" . getUserId() . " 
                  AND DATE(complete_date) between '$startDate' AND '$endDate'";

            $result = $this->conn->query($sql);

            while ($row = $result->fetch_assoc()) {

                if($row["avgPerformance"]==null){
                    $row["avgPerformance"] = 0;
                }
                array_push($arrayData, $row);
            }
        }

        return $arrayData;
    }
}

(new performance())->run();
