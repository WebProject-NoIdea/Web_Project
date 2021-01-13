<h3>Performance 2021 January</h3>
<div id="performanceByDayChartContainer" style="height: 330px; width: 100%;"></div>
<script>
    function showPerformanceByDayChart(year,month) {

        let performanceByDayChartDataPoints = [];

        const performanceByDayChart = new CanvasJS.Chart("performanceByDayChartContainer", {
            animationEnabled: true,
            theme: "light2",
            data: [{
                type: "line",
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

            performanceByDayChart.render();
        }

        $.getJSON("chart/performance.php?year="+year+"&month="+month, performanceByDayChartAddData);
    }
</script>