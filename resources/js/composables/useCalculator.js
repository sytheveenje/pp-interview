import { ref, onMounted, onUnmounted } from 'vue'
import { useHistory } from '../composables/useHistory'
import axios from 'axios'

const { getCalculations } = useHistory()

const input = ref('')
const result = ref('')
const showHistory = ref(false)

const buttons = [
    { label: 'cos', value: 'cos', shortcut: 'c', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: 'sin', value: 'sin', shortcut: 's', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: 'sqrt', value: 'sqrt', shortcut: 'q', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: 'pow', value: '^', shortcut: '^', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: '(', value: '(', shortcut: '(', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: ')', value: ')', shortcut: ')', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: '*', value: '*', shortcut: '*', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: 'π', value: 'pi', shortcut: 'p', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: '7', value: '7', shortcut: '7' },
    { label: '8', value: '8', shortcut: '8' },
    { label: '9', value: '9', shortcut: '9' },
    { label: '+', value: '+', shortcut: '+', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: '4', value: '4', shortcut: '4' },
    { label: '5', value: '5', shortcut: '5' },
    { label: '6', value: '6', shortcut: '6' },
    { label: '-', value: '-', shortcut: '-', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: '1', value: '1', shortcut: '1' },
    { label: '2', value: '2', shortcut: '2' },
    { label: '3', value: '3', shortcut: '3' },
    { label: '/', value: '/', shortcut: '/', bgcolor: 'bg-gray-500 hover:bg-gray-400'},
    { label: 'AC', value: 'clear', shortcut: 'escape', bgcolor: 'bg-red-500 hover:bg-red-700' },
    { label: '0', value: '0', shortcut: '0' },
    { label: '.', value: '.', shortcut: '.' },
    { label: '=', value: '=', shortcut: 'Enter', bgcolor: 'bg-blue-500 hover:bg-blue-700' }
]

async function calculate() {
    try {
        const response = await axios.post('/api/calculate', { input: input.value })
        result.value = response.data.result
        input.value = ''
        await getCalculations()
    } catch (error) {
        result.value = error.response?.data?.error || 'An unexpected error occurred'
        input.value = ''
    }
}

function clear() {
    input.value = ''
    result.value = ''
}

const handleButtonClick = (value) => {
    result.value = ''
    if (value === '=') {
        calculate()
    }
    else if (value === 'clear') {
        clear()
    } else {
        input.value += value
    }
}

const handleKeydown = (event) => {
    if(event.key === 'h') {
        toggleHistory()
        event.preventDefault()
    }
    const button = buttons.find(b => b.shortcut === event.key)
    if (button) {
        handleButtonClick(button.value)
        event.preventDefault()
    }
}

const toggleHistory = () => {
    showHistory.value = !showHistory.value
}

function setupEventListeners() {

    onMounted(() => {
        window.addEventListener('keydown', handleKeydown)
        getCalculations()
    })

    onUnmounted(() => {
        window.removeEventListener('keydown', handleKeydown)
    })
}

export const useCalculator = () => {
    setupEventListeners()
    return {
        input,
        result,
        showHistory,
        buttons,
        calculate,
        handleButtonClick,
        toggleHistory,
    }
}
