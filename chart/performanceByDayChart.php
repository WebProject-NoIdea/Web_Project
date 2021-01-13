<div id="performanceByDayChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    function showPerformanceByDayChart() {

        let performanceByDayChartDataPoints = [];

        const performanceByDayChart = new CanvasJS.Chart("performanceByDayChartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Simple Line Chart"
            },
            data: [{
                type: "line",
                indexLabelFontSize: 16,
                dataPoints: performanceByDayChartDataPoints
            }]
        });

        function performanceByDayChartAddData(data) {

            const avgPerformancePerDay = data.avgPerformancePerDay

            for (let i = 0; i < avgPerformancePerDay.length; i++) {
                performanceByDayChartDataPoints.push({
                    x: new Date(avgPerformancePerDay[i].date),
                    y: 20
                });
            }

            performanceByDayChart.render();
        }

        $.getJSON("chart/performance.php", performanceByDayChartAddData);
    }
</script>