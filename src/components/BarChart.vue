<template>
  <Bar v-if="chartData" :data="chartData" :options="chartOptions" />
  <div v-else>Loading chart...</div>
</template>

<script>
import { Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
);

export default {
  name: "BarChart",
  components: { Bar },
  props: {
    chartData: {
      type: Object,
      required: true,
    },
    chartOptions: {
      type: Object,
      default: () => {},
      required: false,
    },
  },
  setup(props) {
    console.log("BarChart component chartData: 1", props.chartData);
  },
};
</script>