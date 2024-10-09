<template>
    <div id="app" style="width: 600px">
      <BarChart v-bind="barChartProps" :options="options"/>
    </div>
</template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue';
  import { Chart, registerables } from 'chart.js';
  import { BarChart, useBarChart } from 'vue-chart-3';
  const props = defineProps({
    title: String,
    labels: Array,
    data : Array,
  })
  Chart.register(...registerables);
  const options = ref({
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: props.title,
        },
      },
    });
  const chartData = computed(() => ({
        labels: props.labels,
        datasets: [
            {
                data: props.data,
                backgroundColor: ['#A95EEA', '#0079AF', '#A95EEA', '#97B0C4', '#A5C8ED'],
            },
        ],
    }));
    
    const { barChartProps, barChartRef } = useBarChart({chartData});
</script>
  
  <style scoped>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  </style>