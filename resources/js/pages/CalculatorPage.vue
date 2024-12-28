<script setup>
import { onMounted } from 'vue'
import Calculator from '../components/Calculator.vue'
import CalculatorHistory from '../components/CalculatorHistory.vue'
import { useCalculator } from "../composables/useCalculator.js";
import { useHistory } from '../composables/useHistory'

const { showHistory, calculations } = useCalculator()
const { getCalculations } = useHistory();

onMounted(() => {
  getCalculations()
})

</script>

<template>
  <div>
    <Calculator />
    <CalculatorHistory v-show="showHistory" :calculations="calculations" />
  </div>
</template>

<style scoped>

</style>