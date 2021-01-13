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



            performanceByDayChartDataPoints.push({
                x: new Date(2021,0,2),
                y: 0
            });

            performanceByDayChartDataPoints.push({
                x: new Date(2021,0,3),
                y: 0
            });

            performanceByDayChart.render();
        }

        $.getJSON("chart/performance.php", performanceByDayChartAddData);
    }
</script>