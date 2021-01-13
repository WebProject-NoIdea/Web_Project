<style>
    .single-chart {
        width: 100%;
        justify-content: space-around ;
    }

    .circular-chart {
        display: block;
        margin: 20px;
        max-height: 300px;

    }

    .circle-bg {
        fill: none;
        stroke: #eee;
        stroke-width: 3.8;
    }

    .circle {
        fill: none;
        stroke-width: 2.8;
        stroke-linecap: round;
        animation: progress 1s ease-out forwards;
    }

    @keyframes progress {
        0% {
            stroke-dasharray: 0 100;
        }
    }

    .percentage {
        fill: #666;
        font-family: sans-serif;
        font-size: 0.5em;
        text-anchor: middle;
    }
</style>
<div style="height: 400px;">
    <div class="single-chart">
        <svg viewBox="0 0 36 36" class="circular-chart">
            <path class="circle-bg"
                  d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path id="circle" class="circle"
                  d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text id="percentage1" x="18" y="20.35" class="percentage">0&nbsp;%</text>
            <text id="percentage2" x="18" y="20.35" class="percentage" style="font-size: 0.15em;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.00</text>
        </svg>
    </div>
    <h4 style="text-align: center;">Average Performance</h4>
</div>
<script>

    function updatePerformanceChart(data) {

        const avgPerformance = data.avgPerformance;

        document.getElementById("percentage1").innerHTML = parseInt(avgPerformance)+"&nbsp;%";
        document.getElementById("percentage2").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;."+parseFloat(avgPerformance).toFixed(2).split(".")[1];
        document.getElementById("circle").style.stroke = "#ff9f00";
        document.getElementById("circle").style.strokeDasharray = (avgPerformance/2)+", 100";

    }

    $.getJSON("chart/performance.php", updatePerformanceChart);
</script>

