<template>

    <div style="width: 350px; height: 350px; position: relative;">

      <Doughnut
        :data="chartData"
        :options="chartOptions"
      />

      <!-- Center label -->
      <div class="center-text">
        <div class="done-text">Done</div>
        <div class="done-value">{{ doneValue }}</div>
      </div>
    </div>

</template>

<script>
import { Doughnut } from "vue-chartjs";
import {
  Chart as ChartJS,
  ArcElement,
  Tooltip,
  Legend
} from "chart.js";

ChartJS.register(ArcElement, Tooltip, Legend);

export default {
  name: "CircleStats",
  components: { Doughnut },
  props:{
    vehicelState:{
      default:{}
    }
  },

  data() {
      return {
        doneValue: 2,
        totalSegments: 30, // total circular parts
        completedSegments: 20,   // colored segments (blue)
      };
  },

 computed: {
  chartData() {
    return {
      labels: [],
      datasets: [
        {
          data: new Array(this.totalSegments).fill(1),
          backgroundColor: (ctx) => {
            const chart = ctx.chart;
            const { ctx: canvasCtx, chartArea } = chart;

            if (!chartArea) 
              return Array(this.totalSegments).fill("#008CFF");

            const gradient = canvasCtx.createLinearGradient(
              0, chartArea.top, 
              0, chartArea.bottom   
            );

            gradient.addColorStop(0, "#3399ff"); 
            gradient.addColorStop(1, "#0077ff"); 

            const colors = [];

            for (let i = 0; i < this.totalSegments; i++) {
              colors.push(i < this.completedSegments ? gradient : "#343E4B");
            }
            return colors;
          },
          borderWidth: 3,
          borderColor: "#0A101E",
          hoverBorderColor: "#0A101E",
          cutout: "70%",
          spacing: 4,
        }
      ]
    };
  }
}

  
};
</script>

<style>
.center-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white;
}

.done-text {
  font-size: 18px;
  opacity: 0.7;
}

.done-value {
  font-size: 40px;
  font-weight: bold;
}
</style>
