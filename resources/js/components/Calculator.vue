<script setup>
import { useCalculator } from '../composables/useCalculator.js'

const { input, result, toggleHistory, buttons, handleButtonClick } = useCalculator()
</script>

<template>
  <div class="bg-black text-white p-10 font-mono max-w-3xl mx-auto rounded-t-lg shadow-lg">
    <div class="mb-4">
      <input
          v-if="result"
          :value="result"
          type="text"
          class="text-black text-xl p-2 rounded w-full"
          placeholder="Enter calculation"
          readonly
      />
      <input
          v-else
          v-model="input"
          type="text"
          class="text-black text-xl p-2 rounded w-full"
          placeholder="Enter calculation"
      />
    </div>
    <div class="grid grid-cols-4 gap-2 mb-4">
      <div v-for="button in buttons"
           :key="button.label"
           class="group relative">
        <button
            @click="handleButtonClick(button.value)"
            :class="[
              button.bgcolor || 'bg-gray-700 hover:bg-gray-500',
              'text-white font-bold py-2 rounded w-full'
            ]"
            :aria-label="`Button for ${button.label}`"
        >
          {{ button.label }}
        </button>
        <span
            v-if="button.shortcut"
            class="absolute text-xs text-gray-300 bg-gray-800 px-1 py-0.5 rounded hidden group-hover:block top-[-1.5rem] right-0"
        >
          Shortcut: {{ button.shortcut }}
        </span>
      </div>

    </div>
    <button
        @click="toggleHistory"
        class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded w-full"
    >
      Toggle history
    </button>
  </div>
</template>
