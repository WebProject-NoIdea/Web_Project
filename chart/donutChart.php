<div id="doughnutChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    function showDoughnutChart(year,month) {

        let doughnutChartDataPoints = [];

        const doughnutChart = new CanvasJS.Chart("doughnutChartContainer", {
            animationEnabled: true,
            data: [{
                type: "doughnut",
                startAngle: 60, //innerRadius: 60,
                indexLabelFontSize: 16,
                indexLabel: "#percent%",
                toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                legendMarkerType: "square",
                showInLegend: true,
                dataPoints: doughnutChartDataPoints
            }]
        });

        function doughnutChartAddData(data) {
            doughnutChartDataPoints.push({
                y: parseInt(data.statistics.completed),
                name: "Completed",
                color: "#00e600"
            });
            doughnutChartDataPoints.push({
                y: parseInt(data.statistics.in_progress),
                name: "In Progress",
                color: "#ff9f00"
            });
            doughnutChartDataPoints.push({
                y: parseInt(data.statistics.overdue),
                name: "Overdue",
                color: "#ff0000"
            });

            doughnutChart.render();
        }

        $.getJSON("chart/statistics.php?year=" + year + "&month=" + month, doughnutChartAddData);
    }
</script>