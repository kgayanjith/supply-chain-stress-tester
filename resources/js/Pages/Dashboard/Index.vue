<template>
  <AppLayout>
   <main>
    <!-- Line Chart -->
    <div class="row">
      <div class="col-md-6">
        <div class="card p-3">
           <div style="height: 320px; margin-top: 20px;">
            <canvas ref="lineChart"></canvas>
          </div>
        </div>
      </div>
    </div>
   </main>
  </AppLayout>
</template>

<script>
import InputComponent from '@/Components/InputComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  Chart,
  LineController,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend,
  Title,
} from "chart.js";

Chart.register(
  LineController,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend,
  Title
);



export default {
  components: {
    AppLayout,
    InputComponent
  },
  mounted() {
    const labels = ["Mon", "Tue", "Wed", "Thu", "Fri"];
    const values = [12, 19, 7, 15, 22];

    this.chart = new Chart(this.$refs.lineChart, {
      type: "line",
      data: {
        labels,
        datasets: [
          {
            label: "Orders",
            data: values,
            tension: 0.35,
            fill: false,
          },
          {
            label: "Products",
            data: values,
            tension: 0.55,
            fill: false,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: { display: true, text: "Weekly Orders" },
          legend: { display: true },
        },
        scales: {
          y: { beginAtZero: true },
        },
      },
    });
  },

  beforeUnmount() {
    if (this.chart) this.chart.destroy();
  },
}
</script>

<style></style>