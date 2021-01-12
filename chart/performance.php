<?php
class performance
{
    private $conn;

    public function __construct()
    {
        include("../session.php");
        $this->conn = include('../dbConnect.php');
        checkLogin();
    }

    public function run()
    {
        echo $this->avgPerformance();
        echo $this->avgPerformancePerDay();
        $this->conn->close();
    }

    private function avgPerformance(){
        $sql = "SELECT AVG(performance) AS avgPerformance
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' AND user_id=" . getUserId();

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        return json_encode(round($row["avgPerformance"],2));
    }

    private function avgPerformancePerDay(){
        $sql = "SELECT DATE(complete_date) AS date, AVG(performance) AS avgPerformance 
                FROM task 
                WHERE complete_date != '0000-00-00 00:00:00' AND user_id=".getUserId()."
                GROUP BY DATE(complete_date) 
                ORDER BY complete_date";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        return json_encode($row);
    }
}

(new performance())->run();

