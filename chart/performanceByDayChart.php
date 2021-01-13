<h3>Average Performance</h3>
<h4 id="performanceByDayChartTitle" style="padding-left:10px; padding-bottom: 30px;"></h4>

<div class="form-group col-sm-3">
    <label class="control-label" for="performanceByDayChartInput">Start Date</label>
    <div class="input-group" id="performanceByDayChartDatepicker">
        <input type="text" class="form-control" name="startDate" id="performanceByDayChartInput" autocomplete="off" required>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
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