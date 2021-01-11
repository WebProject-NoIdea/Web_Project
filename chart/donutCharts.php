<div id="doughnutChartContainer" style="height: 370px; width: 100%;"></div>
<script>

    window.onload = function(){
        showDoughnutChart("all");
    }

    function showDoughnutChart(type) {

        let doughnutChartDataPoints = [];

        const doughnutChart = new CanvasJS.Chart("doughnutChartContainer", {
            animationEnabled: true,
            data: [{
                type: "doughnut",
                startAngle: 60, //innerRadius: 60,
                indexLabelFontSize: 12,
                indexLabel: "{name} #percent%",
                toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                legendMarkerType: "square",
                showInLegend: true,
                dataPoints: doughnutChartDataPoints
            }]
        });

        function doughnutChartAddData(data) {
            doughnutChartDataPoints.push({
                y: parseInt(data.completed),
                name: "Completed",
                color: "#689F38"
            });
            doughnutChartDataPoints.push({
                y: parseInt(data.in_progress),
                name: "In Progress",
                color: "#E7823A"
            });
            doughnutChartDataPoints.push({
                y: parseInt(data.overdue),
                name: "Overdue",
                color: "#D32F2F"
            });

            doughnutChart.render();
        }

        $.getJSON("chart/statistics.php", doughnutChartAddData);
    }
</script>