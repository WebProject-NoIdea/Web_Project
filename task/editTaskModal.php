<?php
function editModal($row){
    $startDate = date_format(date_create($row['start_date']),"D, d M Y h:i A");
    $endDate = date_format(date_create($row['end_date']),"D, d M Y h:i A");
?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?php echo $row['task_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Task</h4>
                </div>
                <form id="addTaskForm">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="task<?php echo $row['task_id']; ?>">Task</label>
                            <input type="text" class="form-control" id="task<?php echo $row['task_id']; ?>" name="task" placeholder="Task" value="<?php echo $row['task']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description<?php echo $row['task_id']; ?>">Description</label>
                            <input type="text" class="form-control" id="description<?php echo $row['task_id']; ?>" name="description" placeholder="Description" value="<?php echo $row['description']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="control-label" for="input-datepicker-start<?php echo $row['task_id']; ?>">Start Date</label>
                                <div class="input-group" id="datepicker-start<?php echo $row['task_id']; ?>">
                                    <input type="text" class="form-control" name="startDate" id="input-datepicker-start<?php echo $row['task_id']; ?>" value="<?php echo $startDate; ?>" autocomplete="off">
                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label" for="input-datepicker-end<?php echo $row['task_id']; ?>">End Date</label>
                                <div class="input-group" id="datepicker-end<?php echo $row['task_id']; ?>">
                                    <input type="text" class="form-control" name="endDate" id="input-datepicker-end<?php echo $row['task_id']; ?>" value="<?php echo $endDate; ?>" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Linked date and time picker
                            // start date date and time picker
                            $("#datepicker-start<?php echo $row['task_id']; ?>").datetimepicker({
                                format:'ddd, DD MMM Y hh:mm A',
                            });

                            // End date date and time picker
                            $("#datepicker-end<?php echo $row['task_id']; ?>").datetimepicker({
                                format:'ddd, DD MMM Y hh:mm A',
                                useCurrent: false
                            });

                            // start date picke on chagne event [select minimun date for end date datepicker]
                            $("#datepicker-start<?php echo $row['task_id']; ?>").on("dp.change", function (e) {
                                $("#datepicker-end<?php echo $row['task_id']; ?>").data("DateTimePicker").minDate(e.date);
                            });
                            // Start date picke on chagne event [select maxmimum date for start date datepicker]
                            $("#datepicker-end<?php echo $row['task_id']; ?>").on("dp.change", function (e) {
                                $("#datepicker-start<?php echo $row['task_id']; ?>").data("DateTimePicker").maxDate(e.date);
                            });
                        </script>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitBtn<?php echo $row['task_id']; ?>" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

                <script>
                    const addTaskForm = document.getElementById("addTaskForm<?php echo $row['task_id']; ?>");

                    addTaskForm.addEventListener('submit',function (e){
                        e.preventDefault();

                        document.getElementById("submitBtn<?php echo $row['task_id']; ?>").disabled = true;
                        document.getElementById("submitBtn<?php echo $row['task_id']; ?>").innerHTML = "Saving ...";

                        const formData = new FormData(this);

                        fetch('editTask.php',{
                            method: 'post',
                            body: formData
                        }).then(response => {
                            console.log(response.text());
                            if(response.ok){
                                location.reload();
                            }
                        }).catch(error => {
                            console.log(error);
                        });
                    });

                </script>
            </div>
        </div>
    </div>
<?php } ?>