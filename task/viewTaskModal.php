<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Task</h4>
            </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="viewTask">Task</label>
                        <p id="viewTask" style="padding-left: 10px"></p>
                    </div>
                    <div class="form-group">
                        <label for="viewDescription">Description</label>
                        <p id="viewDescription" style="padding-left: 10px"></p>
                    </div>
                    <div class="form-group">
                        <label for="viewInput-datepicker-start">Start Date</label>
                        <p id="viewInput-datepicker-start" style="padding-left: 10px"></p>
                    </div>
                    <div class="form-group">
                        <label for="viewInput-datepicker-end">End Date</label>
                        <p id="viewInput-datepicker-end" style="padding-left: 10px"></p>
                    </div>
                    <div id="completeDate" style="display: none" class="form-group">
                        <label for="viewInput-datepicker-complete">Complete Date</label>
                        <p id="viewInput-datepicker-complete" style="padding-left: 10px"></p>
                    </div>
                    <div id="performance" style="display: none" class="form-group">
                        <label for="viewInput-datepicker-complete">Performance</label>
                        <p id="viewPerformance" style="padding-left: 10px"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>


            <script>

                function view(row){
                    document.getElementById("viewTask").innerHTML = row['task'];
                    document.getElementById("viewDescription").innerText = row['description'];
                    document.getElementById("viewInput-datepicker-start").innerText = row['start_date'];
                    document.getElementById("viewInput-datepicker-end").innerText = row['end_date'];

                    if(row['tableType']==="history"){
                        document.getElementById("viewInput-datepicker-complete").innerText = row['complete_date'];
                        document.getElementById("completeDate").style.display = "block";
                        document.getElementById("viewPerformance").innerText = row['performance'];
                        document.getElementById("performance").style.display = "block";
                    }


                    $("#viewModal").modal();
                }


            </script>
        </div>
    </div>
</div>


