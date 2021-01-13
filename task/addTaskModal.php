<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Task</h4>
            </div>
            <form id="addTaskForm">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" class="form-control" id="task" name="task" placeholder="Task" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="input-datepicker-start">Start Date</label>
                            <div class="input-group" id="datepicker-start">
                                <input type="text" class="form-control" name="startDate" id="input-datepicker-start" autocomplete="off" required>
                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label" for="input-datepicker-end">End Date</label>
                            <div class="input-group" id="datepicker-end">
                                <input type="text" class="form-control" name="endDate" id="input-datepicker-end" autocomplete="off" required>
                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Linked date and time picker
                        // start date date and time picker
                        $('#datepicker-start').datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
                        });

                        // End date date and time picker
                        $('#datepicker-end').datetimepicker({
                            format:'ddd, DD MMM Y hh:mm A',
                            useCurrent: false,
                            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
                        });

                        // start date picke on chagne event [select minimun date for end date datepicker]
                        $("#datepicker-start").on("dp.change", function (e) {
                            const datepickerStart = new Date(e.date);
                            datepickerStart.setMinutes(d.getMinutes() + 1);
                            $('#datepicker-end').data("DateTimePicker").minDate(datepickerStart);
                        });
                        // Start date picke on chagne event [select maxmimum date for start date datepicker]
                        $("#datepicker-end").on("dp.change", function (e) {
                            const datepickerEnd = new Date(e.date);
                            $('#datepicker-start').data("DateTimePicker").maxDate(datepickerEnd);
                        });
                    </script>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>

            <script>
                const addTaskForm = document.getElementById("addTaskForm");

                addTaskForm.addEventListener('submit',function (e){
                    e.preventDefault();

                    document.getElementById("submitBtn").disabled = true;
                    document.getElementById("submitBtn").innerHTML = "Saving ...";

                    const formData = new FormData(this);

                    fetch('addTask.php',{
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