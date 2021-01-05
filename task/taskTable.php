<?php


date_default_timezone_set("Asia/Kuala_Lumpur");

function diffDateInSeconds(String $datetime){
    $timeFirst  = time();
    $timeSecond = strtotime($datetime);
    return $timeSecond - $timeFirst;
}

function taskTable($id){

    switch ($id) {
        case "today":
            $tableName = "Today";

            $sql = "SELECT task_id, task, description, start_date, end_date
                    FROM task 
                    WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)<0 AND complete_date = '0000-00-00 00:00:00' 
                    ORDER BY end_date";
            break;
        case "upcoming":
            $tableName = "Upcoming";

            $sql = "SELECT task_id, task, description, start_date, end_date
                    FROM task 
                    WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)>0 AND complete_date = '0000-00-00 00:00:00' 
                    ORDER BY start_date";
            break;

        default:
            $tableName="";
            $sql="";
    }

?>

    <div id="<?php echo $id; ?>">
        <!-- Tables -->
        <section class="tables">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2><?php echo $tableName; ?></h2>
                        </div>

                        <?php
                        include('../dbconnect.php');



                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) { ?>

                            <div class="default-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Task</th>
                                        <th>Description</th>
                                        <th>End Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $i = 1;

                                    while ($row = $result->fetch_assoc()) {

                                        $row['start_date'] = date_format(date_create($row['start_date']),"D, d M Y h:i A");
                                        $row['end_date'] = date_format(date_create($row['end_date']),"D, d M Y h:i A");

                                        if(diffDateInSeconds($row['end_date'])<0){
                                            echo "<tr style='background-color:#F1948A' id='tableToday_row_$i'>";
                                        }else{
                                            echo "<tr id='tableToday_row_$i'>";
                                        }

                                        echo "    <td>#$i</td>
                                                            <td>".$row['task']."</td>
                                                            <td>".$row['description']."</td>
                                                            <td>".$row['end_date']."</td>
                                                            <td>
                                                                <button class='btn'><i class='fa fa-check-square-o'></i></button>
                                                                <button class='btn' onclick='edit(".json_encode($row).")'><i class='fa fa-pencil'></i></button>
                                                
                                                            </td>
                                                        </tr>";


                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>

                                <?php if($result->num_rows>5){?>

                                    <ul class="table-pagination">
                                        <li onclick="tableToday_prev(1)" id="tableToday_prevBtn"><a>Previous</a></li>
                                        <li onclick="tableToday_prev(2)"><a id="tableToday_btn1">1</a></li>
                                        <li onclick="tableToday_prev(1)"><a id="tableToday_btn2">2</a></li>
                                        <li class="active"><a id="tableToday_btn3">3</a></li>
                                        <li onclick="tableToday_next(1)"><a id="tableToday_btn4">4</a></li>
                                        <li onclick="tableToday_next(2)"><a id="tableToday_btn5">5</a></li>
                                        <li id="tableToday_moreBtn"><a>...</a></li>
                                        <li onclick="tableToday_next(1)" id="tableToday_nextBtn"><a>Next</a></li>
                                    </ul>

                                    <script>

                                        let tableToday_totalRow = <?php echo $result->num_rows; ?>;

                                        let tableToday_currentPage = 1;
                                        let tableToday_totalPage = Math.ceil(tableToday_totalRow/5);


                                        tableToday_showRow();


                                        function tableToday_prev(page){
                                            tableToday_currentPage -= page;
                                            tableToday_showRow();
                                        }

                                        function tableToday_next(page){
                                            tableToday_currentPage += page;
                                            tableToday_showRow();
                                        }

                                        function tableToday_showRow(){
                                            tableToday_reset();

                                            for (let i = (tableToday_currentPage*5)-4; i <= tableToday_currentPage*5; i++) {
                                                document.getElementById('tableToday_row_' + i).style.display = 'table-row';
                                                if(i===tableToday_totalRow){
                                                    break;
                                                }
                                            }

                                            tableToday_reload();
                                        }

                                        function tableToday_reset(){
                                            for (let i = 1; i <= tableToday_totalRow; i++) {
                                                document.getElementById('tableToday_row_' + i).style.display = 'none';
                                            }
                                        }

                                        function tableToday_reload() {
                                            <!-- Previous Button -->
                                            if ((tableToday_currentPage - 1) > 0) {
                                                document.getElementById('tableToday_prevBtn').style.display = 'block';
                                            } else {
                                                document.getElementById('tableToday_prevBtn').style.display = 'none';
                                            }

                                            <!-- Number Button 1 -->
                                            document.getElementById("tableToday_btn1").innerHTML = tableToday_currentPage - 2;
                                            if ((tableToday_currentPage - 2) > 0) {
                                                document.getElementById("tableToday_btn1").style.display = 'block';
                                            } else {
                                                document.getElementById("tableToday_btn1").style.display = 'none';
                                            }

                                            <!-- Number Button 2 -->
                                            document.getElementById("tableToday_btn2").innerHTML = tableToday_currentPage - 1;
                                            if ((tableToday_currentPage - 1) > 0) {
                                                document.getElementById("tableToday_btn2").style.display = 'block';
                                            } else {
                                                document.getElementById("tableToday_btn2").style.display = 'none';
                                            }

                                            <!-- Number Button 3 -->
                                            document.getElementById("tableToday_btn3").innerHTML = tableToday_currentPage;

                                            <!-- Number Button 4 -->
                                            document.getElementById("tableToday_btn4").innerHTML = tableToday_currentPage + 1;
                                            if ((tableToday_currentPage + 1) <= tableToday_totalPage) {
                                                document.getElementById('tableToday_btn4').style.display = 'block';
                                            } else {
                                                document.getElementById('tableToday_btn4').style.display = 'none';
                                            }

                                            <!-- Number Button 5 -->
                                            document.getElementById("tableToday_btn5").innerHTML = tableToday_currentPage + 2;
                                            if ((tableToday_currentPage + 2) <= tableToday_totalPage) {
                                                document.getElementById('tableToday_btn5').style.display = 'block';
                                            } else {
                                                document.getElementById('tableToday_btn5').style.display = 'none';
                                            }

                                            <!-- More Button -->
                                            if ((tableToday_currentPage + 3) <= tableToday_totalPage) {
                                                document.getElementById('tableToday_moreBtn').style.display = 'block';
                                            } else {
                                                document.getElementById('tableToday_moreBtn').style.display = 'none';
                                            }

                                            <!-- Next Button -->
                                            if (tableToday_totalPage > 1 && tableToday_currentPage !== tableToday_totalPage) {
                                                document.getElementById('tableToday_nextBtn').style.display = 'block';
                                            } else {
                                                document.getElementById('tableToday_nextBtn').style.display = 'none';
                                            }
                                        }
                                    </script>
                                <?php }?>

                            </div>
                            <?php
                        }else{
                            echo "No Task";
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php } ?>
