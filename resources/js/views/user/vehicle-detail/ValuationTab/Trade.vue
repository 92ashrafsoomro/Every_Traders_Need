<template>
  <div v-if="!hideForSubscriberPlanOne" style="width:100%; height:400px;">
    <canvas ref="canvas"></canvas>
  </div>
  <div v-else style="
      background-color: rgba(var(--v-theme-primary), 0.2);
      width: 100%;
      height: 400px;
      border-radius: 10px;
    " class="d-flex align-center justify-center">
    <div class="text-primary font-weight-medium">
      Upgrade your plan to view this chart
    </div>
  </div>
</template>

<script>
import { Chart } from "chart.js/auto";
import { useUserStore } from '@/stores/userStore'
export default {
  name: "Trade",

  data() {
    return {
      chart: null,
      userStore: useUserStore(),
    };
  },
  computed: {
    hideForSubscriberPlanOne() {
      return (
        this.userStore?.user?.role === 'Subscriber' &&
        this.userStore?.user?.plan?.plan_id === 1 &&  this.userStore?.user?.plan?.plan_id === 2
      )
    },
  },
  mounted() {
    const canvas = this.$refs.canvas;
    const ctx = canvas.getContext("2d");

    // BLUE GRADIENT
    const blueGradient = ctx.createLinearGradient(0, 0, 0, 350);
    blueGradient.addColorStop(0, "rgba(0, 136, 255, 0.45)");
    blueGradient.addColorStop(1, "rgba(0, 136, 255, 0)");

    // GREEN GRADIENT
    const greenGradient = ctx.createLinearGradient(0, 0, 0, 350);
    greenGradient.addColorStop(0, "rgba(0, 255, 136, 0.45)");
    greenGradient.addColorStop(1, "rgba(0, 255, 136, 0)");

    this.chart = new Chart(ctx, {
      type: "line",
      data: {
        labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN"],
        datasets: [
          {
            label: "CCA",
            data: [12, 25, 18, 30, 22, 40],
            borderColor: "#0090ff",
            backgroundColor: blueGradient,
            fill: true,
            tension: 0.45,
            borderWidth: 2,
            pointRadius: 0,
          },
          {
            label: "MAG",
            data: [10, 18, 15, 25, 20, 33],
            borderColor: "#00ff88",
            backgroundColor: greenGradient,
            fill: true,
            tension: 0.45,
            borderWidth: 2,
            pointRadius: 0,
          },
        ],
      },

      options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
          legend: {
            position: "top",
            labels: {
              color: "#000",
              usePointStyle: true,
            },
          },
          tooltip: {
            enabled: true,
            backgroundColor: "#1f2937",
            titleColor: "#fff",
            bodyColor: "#fff",
          },
        },

        scales: {
          x: {
            ticks: { color: "#9ca3af" },
            grid: {
              color: "rgba(255,255,255,0.05)",
            },
          },
          y: {
            ticks: { color: "#9ca3af" },
            grid: {
              color: "rgba(255,255,255,0.08)",
            },
          },
        },

        layout: {
          padding: 10,
        },
      },
    });
  },

  beforeUnmount() {
    if (this.chart) this.chart.destroy();
  },
};
</script>

<style scoped>
/* Make background dark to match your screenshot */
div {
  /* background: #0b1c2c; */
  border-radius: 10px;
}
</style>
