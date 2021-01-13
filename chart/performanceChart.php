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


    .circular-chart.green .circle {
        stroke: #4CC790;
    }

    .circular-chart.orange .circle {
        stroke: #ff9f00;
    }

    .circular-chart.red .circle {
        stroke: #3c9ee5;
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
            <path class="circle"
                  stroke-dasharray="20, 100"
                  d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text id="percentage" x="18" y="20.35" class="percentage">0%</text>
        </svg>
    </div>
    <h4 style="text-align: center;">Average Performance</h4>
</div>
<script>
    document.getElementById("percentage").innerHTML = "60%";
    document.getElementsByClassName("circular-chart").style.stroke = "#4CC790";
</script>

