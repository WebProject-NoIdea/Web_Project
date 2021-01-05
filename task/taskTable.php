<?php

date_default_timezone_set("Asia/Kuala_Lumpur");

function diffDateInSeconds(String $datetime){
    $timeFirst  = time();
    $timeSecond = strtotime($datetime);
    return $timeSecond - $timeFirst;
}

function diffTwoDateInSeconds(String $datetime1,String $datetime2){
    $timeFirst  = strtotime($datetime1);
    $timeSecond = strtotime($datetime2);
    return $timeSecond - $timeFirst;
}

function taskTable($id,$conn){

    switch ($id) {
        case "today":
            $tableName = "Today";
            $thirdColumn = "End Date";
            $sql = "SELECT task_id, task, description, start_date, end_date
                    FROM task 
                    WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)<0 AND complete_date = '0000-00-00 00:00:00' 
                    ORDER BY end_date";
            break;
        case "upcoming":
            $tableName = "Upcoming";
            $thirdColumn = "Start Date";
            $sql = "SELECT task_id, task, description, start_date, end_date
                    FROM task 
                    WHERE user_id=".getUserId()." AND TIMESTAMPDIFF(MINUTE, DATE_ADD(NOW(), INTERVAL 8 HOUR),start_date)>0 AND complete_date = '0000-00-00 00:00:00' 
                    ORDER BY start_date";
            break;

        case "history":
            $tableName = "History";
            $thirdColumn = "Complete Date";
            $sql = "SELECT task_id, task, description, start_date, end_date, complete_date
                    FROM task 
                    WHERE user_id=".getUserId()." AND complete_date != '0000-00-00 00:00:00' 
                    ORDER BY complete_date DESC";
            break;

        default:
            $tableName="";
            $thirdColumn="";
            $sql="";
    }

?>

    <div id="<?php echo $id; ?>">
        <!-- Tables -->
        <section class="tables" <?php if($id=="upcoming"){echo 'style="margin-top: 0;border-top: 0 !important;"';} ?>>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2><?php echo $tableName; ?></h2>
                        </div>

                        <?php

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) { ?>

                            <div class="default-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Task</th>
                                        <th>Description</th>
                                        <th><?php echo $thirdColumn; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $i = 1;

                                    while ($row = $result->fetch_assoc()) {

                                        $row['start_date'] = date_format(date_create($row['start_date']),"D, d M Y h:i A");
                                        $row['end_date'] = date_format(date_create($row['end_date']),"D, d M Y h:i A");
                                        $row['complete_date'] = date_format(date_create($row['complete_date']),"D, d M Y h:i A");


                                        if($id=="history"){
                                            if(diffTwoDateInSeconds($row['end_date'],$row['complete_date'])>0){
                                                echo "<tr style='background-color:#F1948A' id='".$id."_row_$i'>";
                                            }else{
                                                echo "<tr style='background-color:#80ff80' id='".$id."_row_$i'>";
                                            }
                                        }else{
                                            if(diffDateInSeconds($row['end_date'])<0){
                                                echo "<tr style='background-color:#F1948A' id='".$id."_row_$i'>";
                                            }else{
                                                echo "<tr id='".$id."_row_$i'>";
                                            }
                                        }


                                        echo "    <td onclick='view($id,".json_encode($row).")'>#$i</td>
                                                  <td onclick='view($id,".json_encode($row).")'>".$row['task']."</td>
                                                  <td onclick='view($id,".json_encode($row).")'>".$row['description']."</td>";

                                        switch ($id) {
                                            case "today":
                                                echo "<td>".$row['end_date']."</td>";
                                                break;

                                            case "upcoming":
                                                echo "<td>".$row['start_date']."</td>";
                                                break;

                                            case "history":
                                                echo "<td>".$row['complete_date']."</td>";
                                                break;

                                            default:
                                                echo "<td></td>";
                                        }

                                                           echo "<td>";

                                                            if($id=="today"){
                                                                echo "<button class='btn' onclick='complete(".json_encode($row).")'><i class='fa fa-check-square-o'></i></button>";
                                                            }
                                        echo "                  <button class='btn' onclick='edit(".json_encode($row).")'><i class='fa fa-pencil'></i></button>
                                                
                                                            </td>
                                                        </tr>";


                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>

                                <?php if($result->num_rows>5){?>

                                    <ul class="table-pagination">
                                        <li onclick="<?php echo $id; ?>_prev(1)" id="<?php echo $id; ?>_prevBtn"><a>Previous</a></li>
                                        <li onclick="<?php echo $id; ?>_prev(2)"><a id="<?php echo $id; ?>_btn1">1</a></li>
                                        <li onclick="<?php echo $id; ?>_prev(1)"><a id="<?php echo $id; ?>_btn2">2</a></li>
                                        <li class="active"><a id="<?php echo $id; ?>_btn3">3</a></li>
                                        <li onclick="<?php echo $id; ?>_next(1)"><a id="<?php echo $id; ?>_btn4">4</a></li>
                                        <li onclick="<?php echo $id; ?>_next(2)"><a id="<?php echo $id; ?>_btn5">5</a></li>
                                        <li id="<?php echo $id; ?>_moreBtn"><a>...</a></li>
                                        <li onclick="<?php echo $id; ?>_next(1)" id="<?php echo $id; ?>_nextBtn"><a>Next</a></li>
                                    </ul>

                                    <script>

                                        let <?php echo $id; ?>_totalRow = <?php echo $result->num_rows; ?>;

                                        let <?php echo $id; ?>_currentPage = 1;
                                        let <?php echo $id; ?>_totalPage = Math.ceil(<?php echo $id; ?>_totalRow/5);


                                        <?php echo $id; ?>_showRow();


                                        function <?php echo $id; ?>_prev(page){
                                            <?php echo $id; ?>_currentPage -= page;
                                            <?php echo $id; ?>_showRow();
                                        }

                                        function <?php echo $id; ?>_next(page){
                                            <?php echo $id; ?>_currentPage += page;
                                            <?php echo $id; ?>_showRow();
                                        }

                                        function <?php echo $id; ?>_showRow(){
                                            <?php echo $id; ?>_reset();

                                            for (let i = (<?php echo $id; ?>_currentPage*5)-4; i <= <?php echo $id; ?>_currentPage*5; i++) {
                                                document.getElementById('<?php echo $id; ?>_row_' + i).style.display = 'table-row';
                                                if(i===<?php echo $id; ?>_totalRow){
                                                    break;
                                                }
                                            }

                                            <?php echo $id; ?>_reload();
                                        }

                                        function <?php echo $id; ?>_reset(){
                                            for (let i = 1; i <= <?php echo $id; ?>_totalRow; i++) {
                                                document.getElementById('<?php echo $id; ?>_row_' + i).style.display = 'none';
                                            }
                                        }

                                        function <?php echo $id; ?>_reload() {
                                            <!-- Previous Button -->
                                            if ((<?php echo $id; ?>_currentPage - 1) > 0) {
                                                document.getElementById('<?php echo $id; ?>_prevBtn').style.display = 'block';
                                            } else {
                                                document.getElementById('<?php echo $id; ?>_prevBtn').style.display = 'none';
                                            }

                                            <!-- Number Button 1 -->
                                            document.getElementById("<?php echo $id; ?>_btn1").innerHTML = <?php echo $id; ?>_currentPage - 2;
                                            if ((<?php echo $id; ?>_currentPage - 2) > 0) {
                                                document.getElementById("<?php echo $id; ?>_btn1").style.display = 'block';
                                            } else {
                                                document.getElementById("<?php echo $id; ?>_btn1").style.display = 'none';
                                            }

                                            <!-- Number Button 2 -->
                                            document.getElementById("<?php echo $id; ?>_btn2").innerHTML = <?php echo $id; ?>_currentPage - 1;
                                            if ((<?php echo $id; ?>_currentPage - 1) > 0) {
                                                document.getElementById("<?php echo $id; ?>_btn2").style.display = 'block';
                                            } else {
                                                document.getElementById("<?php echo $id; ?>_btn2").style.display = 'none';
                                            }

                                            <!-- Number Button 3 -->
                                            document.getElementById("<?php echo $id; ?>_btn3").innerHTML = <?php echo $id; ?>_currentPage;

                                            <!-- Number Button 4 -->
                                            document.getElementById("<?php echo $id; ?>_btn4").innerHTML = <?php echo $id; ?>_currentPage + 1;
                                            if ((<?php echo $id; ?>_currentPage + 1) <= <?php echo $id; ?>_totalPage) {
                                                document.getElementById('<?php echo $id; ?>_btn4').style.display = 'block';
                                            } else {
                                                document.getElementById('<?php echo $id; ?>_btn4').style.display = 'none';
                                            }

                                            <!-- Number Button 5 -->
                                            document.getElementById("<?php echo $id; ?>_btn5").innerHTML = <?php echo $id; ?>_currentPage + 2;
                                            if ((<?php echo $id; ?>_currentPage + 2) <= <?php echo $id; ?>_totalPage) {
                                                document.getElementById('<?php echo $id; ?>_btn5').style.display = 'block';
                                            } else {
                                                document.getElementById('<?php echo $id; ?>_btn5').style.display = 'none';
                                            }

                                            <!-- More Button -->
                                            if ((<?php echo $id; ?>_currentPage + 3) <= <?php echo $id; ?>_totalPage) {
                                                document.getElementById('<?php echo $id; ?>_moreBtn').style.display = 'block';
                                            } else {
                                                document.getElementById('<?php echo $id; ?>_moreBtn').style.display = 'none';
                                            }

                                            <!-- Next Button -->
                                            if (<?php echo $id; ?>_totalPage > 1 && <?php echo $id; ?>_currentPage !== <?php echo $id; ?>_totalPage) {
                                                document.getElementById('<?php echo $id; ?>_nextBtn').style.display = 'block';
                                            } else {
                                                document.getElementById('<?php echo $id; ?>_nextBtn').style.display = 'none';
                                            }
                                        }
                                    </script>
                                <?php }?>

                            </div>
                            <?php
                        }else{
                            echo "No Task";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php } ?>
