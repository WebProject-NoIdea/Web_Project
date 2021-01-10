<div id="doughnutChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    window.onload = function () {

        const doughnutChart = new CanvasJS.Chart("doughnutChartContainer", {
            animationEnabled: true,
            title: {
                text: "Email Categories",
                horizontalAlign: "left"
            },
            data: [{
                type: "doughnut",
                startAngle: 60, //innerRadius: 60,
                indexLabelFontSize: 17,
                indexLabel: "{name} - #percent%",
                toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                dataPoints: [
                    { y: 363040, name: "Completed", color: "#689F38" },
                    { y: 519960, name: "In Progress", color: "#E7823A" },
                    { y: 3630, name: "Overdue", color: "#D32F2F" }
                ]
            }]
        });
        doughnutChart.render();

    }
</script>