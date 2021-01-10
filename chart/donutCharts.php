
<script>
    window.onload = function () {

        const chart = new CanvasJS.Chart("chartContainer", {
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
        chart.render();

    }
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>