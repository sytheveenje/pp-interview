<script>
import axios from "axios";

export default {
  data() {
    return {
      history: [],
    };
  },
  async mounted() {
    const response = await axios.get("/api/history");
    this.history = response.data;
  },
};
</script>

<template>
  <div class="font-mono">
    <h2>History</h2>
    <ul>
      <li v-for="days in history" :key="days">
        <h3 class="text-xl font-bold py-3">{{ days.date }}</h3>
        <ul class="mb-5">
          <li v-for="calculation in days.calculations" :key="calculation">
            <p>{{ calculation.input }} = {{ calculation.result }}</p>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>