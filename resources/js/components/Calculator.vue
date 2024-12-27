<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import axios from 'axios'

const input = ref('')
const result = ref('')

const buttons = [
  // { label: 'C', value: 'C', shortcut: 'escape' },
  { label: '(', value: '(', shortcut: '(' },
  { label: ')', value: ')', shortcut: ')' },
  { label: '*', value: '*', shortcut: '*' },
  { label: 'sqrt', value: 'sqrt', shortcut: 's' },
  { label: '7', value: '7', shortcut: '7' },
  { label: '8', value: '8', shortcut: '8' },
  { label: '9', value: '9', shortcut: '9' },
  { label: '+', value: '+', shortcut: '+' },
  { label: '4', value: '4', shortcut: '4' },
  { label: '5', value: '5', shortcut: '5' },
  { label: '6', value: '6', shortcut: '6' },
  { label: '-', value: '-', shortcut: '-' },
  { label: '1', value: '1', shortcut: '1' },
  { label: '2', value: '2', shortcut: '2' },
  { label: '3', value: '3', shortcut: '3' },
  { label: '/', value: '/', shortcut: '/' },
  { label: '...', value: '...', shortcut: 'h' },
  { label: '0', value: '0', shortcut: '0' },
  { label: '.', value: '.', shortcut: '.' },
  { label: '=', value: '=', shortcut: 'Enter' },

]

const handleButtonClick = (value) => {
  result.value = '';
  if (value === '=') {
    calculate()
    input.value = ''
  } else {
    input.value += value
  }
}

const calculate = async () => {
  try {
    const response = await axios.post('/api/calculate', { input: input.value })
    result.value = response.data.result
  } catch (error) {
    if (error.response?.data?.error) {
      result.value = `Error: ${error.response.data.error}`
    } else {
      result.value = 'An unexpected error occurred'
    }
  }
}

const handleKeydown = (event) => {
  const button = buttons.find(b => b.shortcut === event.key)
  if (button) {
    handleButtonClick(button.value)
    event.preventDefault()
  }
}

onMounted(() => window.addEventListener('keydown', handleKeydown))
onUnmounted(() => window.removeEventListener('keydown', handleKeydown))
</script>

<template>
  <div class="bg-black text-white p-10 font-mono max-w-md mx-auto rounded-lg shadow-lg">
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
          readonly
      />
    </div>
    <div class="grid grid-cols-4 gap-2 mb-4">
      <button
          v-for="button in buttons"
          :key="button.label"
          @click="handleButtonClick(button.value)"
          class="bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 rounded"
      >
        {{ button.label }}
      </button>
    </div>
    <button
        @click="calculate"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full"
    >
      Calculate
    </button>
  </div>
</template>
