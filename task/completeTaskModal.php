<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Complete Task</h4>
            </div>
            <form id="completeTaskForm">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="completeTask">Task</label>
                        <p id="completeTask" style="padding-left: 10px"></p>
                    </div>
                    <div class="form-group">
                        <label for="completeDescription">Description</label>
                        <p id="completeDescription" style="padding-left: 10px"></p>
                    </div>
                    <div class="form-group">
                        <label for="completeInput-datepicker-start">Start Date</label>
                        <p id="completeInput-datepicker-start" style="padding-left: 10px"></p>
                    </div>
                    <div class="form-group">
                        <label for="completeInput-datepicker-end">End Date</label>
                        <p id="completeInput-datepicker-end" style="padding-left: 10px"></p>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="completeInput-datepicker-complete">Complete Date</label>
                            <div class="input-group" id="completeDatepicker-complete">
                                <input type="text" class="form-control" name="completeDate" id="completeInput-datepicker-complete" autocomplete="off" required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <script>

                        $("#completeDatepicker-complete").datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom',
                            }
                        }).data("DateTimePicker").maxDate('<?php echo date("D, d M Y h:i A");?>');
                    </script>

                    <input type="hidden" name="taskId" id="completeTaskId">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" id="completeSubmitBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>

            <script>

                function complete(row){
                    document.getElementById("completeTask").innerHTML = row['task'];
                    document.getElementById("completeDescription").innerText = row['description'];
                    document.getElementById("completeInput-datepicker-start").innerText = row['start_date'];
                    document.getElementById("completeInput-datepicker-end").innerText = row['end_date'];
                    $("#completeDatepicker-complete").data("DateTimePicker").minDate(row['start_date']);

                    document.getElementById("completeTaskId").value = row['task_id'];
                    $("#completeModal").modal();
                }


                const completeTaskForm = document.getElementById("completeTaskForm");

                completeTaskForm.addEventListener('submit',function (e){
                    e.preventDefault();

                    document.getElementById("completeSubmitBtn").disabled = true;
                    document.getElementById("completeSubmitBtn").innerHTML = "Saving ...";

                    const formData = new FormData(this);

                    fetch('completeTask.php',{
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


