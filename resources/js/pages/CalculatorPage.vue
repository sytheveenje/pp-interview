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
  <div class="font-mono py-10 bg-gray-800 min-h-screen">
    <h1 class="text-center font-bold text-2xl pb-3 text-white ">Casio Systems <span class="italic text-sm">PPv0.1</span></h1>
    <Calculator />
    <CalculatorHistory v-show="showHistory" :calculations="calculations" />
  </div>
</template>

<style scoped>

</style>