<?php
    //$startDate = date_format(date_create($row['start_date']),"D, d M Y h:i A");
    //$endDate = date_format(date_create($row['end_date']),"D, d M Y h:i A");
?>
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
                            <label class="control-label" for="input-datepicker-start">Start Date</label>
                            <div class="input-group" id="editDatepicker-start">
                                <input type="text" class="form-control" name="startDate" id="input-datepicker-start" autocomplete="off">
                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="input-datepicker-end">End Date</label>
                            <div class="input-group" id="editDatepicker-end">
                                <input type="text" class="form-control" name="endDate" id="input-datepicker-end" autocomplete="off">
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

                        });

                        // End date date and time picker
                        $("#editDatepicker-end").datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            useCurrent: false,
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
                        });

                        // start date picke on chagne event [select minimun date for end date datepicker]
                        $("#datepicker-start").on("dp.change", function (e) {
                            $("#datepicker-end").data("DateTimePicker").minDate(e.date);
                        });
                        // Start date picke on chagne event [select maxmimum date for start date datepicker]
                        $("#datepicker-end").on("dp.change", function (e) {
                            $("#datepicker-start").data("DateTimePicker").maxDate(e.date);
                        });
                    </script>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" id="editSubmitBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>

            <script>

                function edit(row){

                    document.getElementById("editTask").value = row['task'];
                    document.getElementById("editDescription").value = row['description'];
                    $("#editModal").modal();
                    console.log(row);
                }


                const editTaskForm = document.getElementById("editTaskForm");

                editTaskForm.addEventListener('submit',function (e){
                    e.preventDefault();

                    document.getElementById("editSubmitBtn").disabled = true;
                    document.getElementById("editSubmitBtn").innerHTML = "Saving ...";

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


