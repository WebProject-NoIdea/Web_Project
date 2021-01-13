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

            for (let i = 0; i < data.length; i++) {
                performanceByDayChartDataPoints.push({
                    x: new Date(data[i].date),
                    y: data[i].avgPerformance
                });
            }

            performanceByDayChart.render();
        }

        $.getJSON("chart/performance.php", performanceByDayChartAddData);
    }
</script>