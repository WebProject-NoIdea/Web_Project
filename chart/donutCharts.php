<div id="doughnutChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    window.onload = function () {

        let doughnutChartDataPoints = [];

        const doughnutChart = new CanvasJS.Chart("doughnutChartContainer", {
            animationEnabled: true,
            title: {
                text: "This Week",
                horizontalAlign: "left"
            },
            data: [{
                type: "doughnut",
                startAngle: 60, //innerRadius: 60,
                indexLabelFontSize: 12,
                indexLabel: "{name} #percent%",
                toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                dataPoints: doughnutChartDataPoints
            }]
        });

        function doughnutChartAddData(data) {
            doughnutChartDataPoints.push({
                y: data.completed,
                name: "Completed",
                color: "#689F38"
            });
            doughnutChartDataPoints.push({
                y: data.in_progress,
                name: "In Progress",
                color: "#E7823A"
            });
            doughnutChartDataPoints.push({
                y: data.overdue,
                name: "Overdue",
                color: "#D32F2F"
            });

            doughnutChart.render();
        }

        $.getJSON("chart/statistics.php", doughnutChartAddData);
    }
</script>