<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Task</h4>
            </div>
            <form id="editTaskForm">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="editTask">Task</label>
                        <input type="text" class="form-control" id="editTask" name="task" placeholder="Task" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <input type="text" class="form-control" id="editDescription" name="description" placeholder="Description" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="editInput-datepicker-start">Start Date</label>
                            <div class="input-group" id="editDatepicker-start">
                                <input type="text" class="form-control" name="startDate" id="editInput-datepicker-start" autocomplete="off" required>
                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="editInput-datepicker-end">End Date</label>
                            <div class="input-group" id="editDatepicker-end">
                                <input type="text" class="form-control" name="endDate" id="editInput-datepicker-end" autocomplete="off" required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div id="completeDateField" class="row" style="display: none;">
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="editInput-datepicker-complete">Complete Date</label>
                            <div class="input-group" id="editDatepicker-complete">
                                <input type="text" class="form-control" name="completeDate" id="editInput-datepicker-complete" autocomplete="off" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>



                    <script>
                        // Linked date and time picker
                        // start date date and time picker
                        $("#editDatepicker-start").datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
                        }).on("dp.change", function (e) {
                            // start date picke on chagne event [select minimun date for end date datepicker]
                            const editDatepickerStart = new Date(e.date);
                            editDatepickerStart.setMinutes(editDatepickerStart.getMinutes() + 1);
                            $("#editDatepicker-end").data("DateTimePicker").minDate(editDatepickerStart);
                        });

                        // End date date and time picker
                        $("#editDatepicker-end").datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            useCurrent: false,
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
                        }).on("dp.change", function (e) {
                            // Start date picke on chagne event [select maxmimum date for start date datepicker]
                            const editDatepickerEnd = new Date(e.date);
                            editDatepickerEnd.setMinutes(editDatepickerEnd.getMinutes() - 1);
                            $("#editDatepicker-start").data("DateTimePicker").maxDate(editDatepickerEnd);
                        });

                        // End date date and time picker
                        $("#editDatepicker-complete").datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
                        });

                    </script>

                    <input type="hidden" name="taskId" id="editTaskId">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="button" id="editDeleteBtn" class="btn btn-danger" onclick="deleteTask()" data-dismiss="modal">Delete</button>
                    <button type="submit" id="editSubmitBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>

            <script>

                function edit(row){
                    document.getElementById("editTask").value = row['task'];
                    document.getElementById("editDescription").value = row['description'];
                    document.getElementById("editInput-datepicker-start").value = row['start_date'];
                    document.getElementById("editInput-datepicker-end").value = row['end_date'];
                    document.getElementById("editTaskId").value = row['task_id'];
                    $("#editDatepicker-end").data("DateTimePicker").minDate(row['start_date']);
                    $("#editDatepicker-start").data("DateTimePicker").maxDate(row['end_date']);
                    document.getElementById("editInput-datepicker-complete").disabled = true;

                    if(row['tableType']==="history"){
                        document.getElementById("editInput-datepicker-complete").value = row['complete_date'];
                        document.getElementById("completeDateField").style.display = "block";
                    }

                    $("#editModal").modal();
                }

                function deleteTask(){
                    const result = confirm('Are you sure you want to delete this task?');

                    if (result) {
                        document.getElementById("editDeleteBtn").disabled = true;
                        document.getElementById("editDeleteBtn").innerHTML = "Deleting ...";
                        document.getElementById("editSubmitBtn").disabled = true;

                        const deleteFormData = new FormData();
                        deleteFormData.append('taskId', document.getElementById("editTaskId").value);

                        <?php
                            $urlExt = "";

                            $array = explode('/',$_SERVER['REQUEST_URI']);
                            if( $array[count($array)-2]!="task"){
                                $urlExt = "task/";
                            }
                        ?>
                        fetch('<?php echo $urlExt; ?>deleteTask.php',{
                            method: 'post',
                            body: deleteFormData
                        }).then(response => {
                            console.log(response.text());
                            if(response.ok){
                                location.reload();
                            }
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }


                const editTaskForm = document.getElementById("editTaskForm");

                editTaskForm.addEventListener('submit',function (e){
                    e.preventDefault();

                    document.getElementById("editSubmitBtn").disabled = true;
                    document.getElementById("editSubmitBtn").innerHTML = "Saving ...";

                    const formData = new FormData(this);

                    fetch('<?php echo $urlExt; ?>editTask.php',{
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


