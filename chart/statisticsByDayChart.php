<h3>Statistics</h3>
<h4 id="statisticsByDayChartTitle" style="padding-left:10px; padding-bottom: 30px;"></h4>
<div id="statisticsByDayChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    function showStatisticsByDayChart(year,month) {

        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let statisticsByDayChartDataPoints = [];

        const statisticsByDayChart = new CanvasJS.Chart("statisticsByDayChartContainer", {
            animationEnabled: true,
            theme: "light2",
            axisY: {
                title: "Task",
            },
            data: [{
                    type: "line",
                    markerSize: 0,
                    indexLabelFontSize: 16,
                    dataPoints: statisticsByDayChartDataPoints
                }],
                [{
                    type: "line",
                    markerSize: 0,
                    indexLabelFontSize: 16,
                    dataPoints: statisticsByDayChartDataPoints
                }],
                [{
                    type: "line",
                    markerSize: 0,
                    indexLabelFontSize: 16,
                    dataPoints: statisticsByDayChartDataPoints
                }],
        });

        function statisticsByDayChartAddData(data) {

            const statisticsPerDay = data.statisticsPerDay;

            for (let i = 0; i < statisticsPerDay.length; i++) {
                statisticsByDayChartDataPoints.push({
                    x: new Date(statisticsPerDay[i].date),
                    y: parseFloat(statisticsPerDay[i].completed)
                });
            }

            document.getElementById("statisticsByDayChartTitle").innerHTML = year+" "+monthNames[month-1];

            statisticsByDayChart.render();
        }

        $.getJSON("chart/statistics.php?year="+year+"&month="+month, statisticsByDayChartAddData);
    }
</script>