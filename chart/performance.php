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
        $sql = "SELECT AVG(performance) AS avgPerformance
         FROM task WHERE user_id=" . getUserId();

        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo json_encode(round($row["avgPerformance"],2));
        }

        $this->conn->close();
    }
}

(new performance())->run();

