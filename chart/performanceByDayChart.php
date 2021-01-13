<div id="performanceByDayChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    function showPerformanceByDayChart() {

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

            const year = 2021;
            const month = 0+1;

            performanceByDayChartDataPoints.push({
                x: new Date(year, month-1, 1),
                y: 0
            });

            performanceByDayChartDataPoints.push({
                x: new Date(year, month, 0),
                y: 0
            });

            for (let i = 0; i < avgPerformancePerDay.length; i++) {
                performanceByDayChartDataPoints.push({
                    x: new Date(avgPerformancePerDay[i].date),
                    y: parseFloat(avgPerformancePerDay[i].avgPerformance)
                });
            }



            performanceByDayChart.render();
        }

        $.getJSON("chart/performance.php?year=".year."&month=".month, performanceByDayChartAddData);
    }
</script>