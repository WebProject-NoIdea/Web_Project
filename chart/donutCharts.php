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
                indexLabel: "{name} - #percent%",
                toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                dataPoints: doughnutChartDataPoints
            }]
        });

        function doughnutChartAddData(data) {
            doughnutChartDataPoints = [
                { y: data['complete'], name: "Completed", color: "#689F38" },
                { y: data['in_progress'], name: "In Progress", color: "#E7823A" },
                { y: data['overdue'], name: "Overdue", color: "#D32F2F" }
            ]
            doughnutChart.render();
        }

        $.getJSON("http://www.breakvoid.com/Web_Project/chart/statistics.php", doughnutChartAddData);
    }
</script>