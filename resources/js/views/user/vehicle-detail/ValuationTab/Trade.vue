<template>
  <div style="width: 600px; height: 350px;">
    <canvas ref="canvas"></canvas>
  </div>
</template>

<script>
import { Chart } from "chart.js/auto"; // FIXES the error

export default {
  name: "Trade",

  data() {
    return {
      chart: null,
    };
  },

  mounted() {
    const ctx = this.$refs.canvas;

    this.chart = new Chart(ctx, {
      type: "line", // CHANGE THIS for other chart types
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr"],
        datasets: [
          {
            label: "Revenue",
            data: [10, 20, 15, 30],
            backgroundColor: ["#4F46E5", "#22C55E", "#F59E0B", "#EF4444"],
          },
          {
            label: "Sales",
            data: [10, 20, 15, 30],
            backgroundColor: ["#4F46E5", "#22C55E", "#F59E0B", "#EF4444"],
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: { color: "#000" },
          },
        },
        scales: {
          x: { ticks: { color: "#000" } },
          y: { ticks: { color: "#000" } },
        },
      },
    });
  },

  beforeUnmount() {
    if (this.chart) this.chart.destroy();
  },
};
</script>

<style>
/* optional */
</style>
