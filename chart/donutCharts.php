<div id="doughnutChartContainer" style="height: 370px; width: 100%;"></div>
<script>
    window.onload = function () {

        const doughnutChart = new CanvasJS.Chart("doughnutChartContainer", {
            animationEnabled: true,
            title: {
                text: "This Week",
                horizontalAlign: "left"
            },
            data: [{
                type: "doughnut",
                startAngle: 60, //innerRadius: 60,
                indexLabelFontSize: 17,
                indexLabel: "{name} - #percent%",
                toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                dataPoints: [
                    { y: 10, name: "Completed", color: "#689F38" },
                    { y: 1, name: "In Progress", color: "#E7823A" },
                    { y: 1, name: "Overdue", color: "#D32F2F" }
                ]
            }]
        });
        doughnutChart.render();

    }
</script>