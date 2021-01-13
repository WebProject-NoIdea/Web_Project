<h3>Statistics</h3>
<h4 id="statisticsByDayChartTitle" style="padding-left:10px; padding-bottom: 30px;"></h4>
<div id="statisticsByDayChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    function showStatisticsByDayChart(year,month) {

        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let statisticsByDayChartDataPointsCompleted = [];
        let statisticsByDayChartDataPointsOverdue = [];
        let statisticsByDayChartDataPointsInProgress = [];

        const statisticsByDayChart = new CanvasJS.Chart("statisticsByDayChartContainer", {
            animationEnabled: true,
            theme: "light2",
            axisY: {
                title: "No of Task",
            },
            toolTip: {
                shared: true
            },
            data: [{
                    name: "Completed",
                    type: "line",
                    showInLegend: true,
                    color: "#00e600",
                    markerSize: 0,
                    indexLabelFontSize: 16,
                    dataPoints: statisticsByDayChartDataPointsCompleted
                },
                {
                    name: "Overdue",
                    type: "line",
                    color: "#ff0000",
                    showInLegend: true,
                    markerSize: 0,
                    indexLabelFontSize: 16,
                    dataPoints: statisticsByDayChartDataPointsOverdue
                },
                {
                    name: "In Progress",
                    type: "line",
                    color: "#ff9f00",
                    showInLegend: true,
                    markerSize: 0,
                    indexLabelFontSize: 16,
                    dataPoints: statisticsByDayChartDataPointsInProgress
                }],
        });

        function statisticsByDayChartAddData(data) {

            const statisticsPerDay = data.statisticsPerDay;

            for (let i = 0; i < statisticsPerDay.length; i++) {
                statisticsByDayChartDataPointsCompleted.push({
                    x: new Date(statisticsPerDay[i].date),
                    y: parseFloat(statisticsPerDay[i].completed)
                });

                statisticsByDayChartDataPointsOverdue.push({
                    x: new Date(statisticsPerDay[i].date),
                    y: parseFloat(statisticsPerDay[i].overdue)
                });

                statisticsByDayChartDataPointsInProgress.push({
                    x: new Date(statisticsPerDay[i].date),
                    y: parseFloat(statisticsPerDay[i].in_progress)
                });
            }

            document.getElementById("statisticsByDayChartTitle").innerHTML = year+" "+monthNames[month-1];

            statisticsByDayChart.render();
        }

        $.getJSON("chart/statistics.php?year="+year+"&month="+month, statisticsByDayChartAddData);
    }
</script>