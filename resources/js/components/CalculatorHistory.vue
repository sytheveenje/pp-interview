<script setup>
import {useCalculator} from "../composables/useCalculator.js";

const {calculations, clearHistory, copyCalculationInput, deleteCalculation} = useCalculator()

defineProps({
  calculations: {
    type: Array,
    default: () => []
  }
})
</script>

<template>
  <div class="font-mono max-w-3xl mx-auto rounded-b-lg shadow-lg bg-black text-white p-3">
    <div class="flex py-3 border-b">
      <h2 class="text-xl font-bold">History</h2>
      <button @click="destroyCalculations()" class="ml-auto">Clear history</button>
    </div>
    <ul>
      <li v-for="days in calculations" :key="days"
          class="grid grid-cols-4 gap-4 my-5">
        <h3 class="text-sm uppercase font-bold">{{ days.date }}</h3>
        <ul class=" col-span-3">
          <li v-for="calculation in days.calculations" :key="calculation.id"
          class="flex justify-between mb-3">
            <span @click="copyCalculationInput(calculation)" class="cursor-pointer">
              {{ calculation.input }} = {{ calculation.result }}
            </span>
            <span>
              <button @click="deleteCalculation(calculation.id)">x</button>
            </span>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>