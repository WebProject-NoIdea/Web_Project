<h3>Average Performance</h3>

<h4 id="performanceByDayChartTitle" style="padding-left:10px;display: inline-block;">2021 January</h4>
<button class="btn small" id="performanceByDayChartDatepicker">Change</button>

<div style="overflow:hidden;">
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <div id="datetimepicker12"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker12').datetimepicker({
                format:'Y MMMM',
                inline: true,
                sideBySide: true
            });
        });
    </script>
</div>

<script>
    // Linked date and time picker
    // start date date and time picker
    $('#performanceByDayChartDatepicker').datetimepicker({
        format:'Y MMMM',
        widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });

    $('#dp5').datepicker()
        .on('changeDate', function(ev){
            if (ev.date.valueOf() < startDate.valueOf()){
                $('#alert').show().find('strong').text('The end date can not be less then the start date');
            } else {
                $('#alert').hide();
                endDate = new Date(ev.date);
                $('#endDate').text($('#dp5').data('date'));
            }
            $('#dp5').datepicker('hide');
        });
</script>

<div id="performanceByDayChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    function showPerformanceByDayChart(year,month) {

        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let performanceByDayChartDataPoints = [];

        const performanceByDayChart = new CanvasJS.Chart("performanceByDayChartContainer", {
            animationEnabled: true,
            theme: "light2",
            axisY: {
                title: "Average Performance",
                maximum: 200,
            },
            data: [{
                type: "line",
                markerSize: 0,
                indexLabelFontSize: 16,
                dataPoints: performanceByDayChartDataPoints
            }]
        });

        function performanceByDayChartAddData(data) {

            const avgPerformancePerDay = data.avgPerformancePerDay;

            for (let i = 0; i < avgPerformancePerDay.length; i++) {
                performanceByDayChartDataPoints.push({
                    x: new Date(avgPerformancePerDay[i].date),
                    y: parseFloat(avgPerformancePerDay[i].avgPerformance)
                });
            }

            document.getElementById("performanceByDayChartTitle").innerHTML = year+" "+monthNames[month-1];

            performanceByDayChart.render();
        }

        $.getJSON("chart/performance.php?year="+year+"&month="+month, performanceByDayChartAddData);
    }
</script>