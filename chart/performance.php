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
        $this->conn->close();
    }

    private function avgPerformance(){
        $sql = "SELECT AVG(performance) AS avgPerformance
         FROM task WHERE user_id=" . getUserId();

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        return json_encode(round($row["avgPerformance"],2));
    }
}

(new performance())->run();

