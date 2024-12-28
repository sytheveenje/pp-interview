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
  <div>
    <h2>History</h2>
    <ul>
      <li v-for="entry in history" :key="entry.id">
        {{ entry.input }} = {{ entry.result }}
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>