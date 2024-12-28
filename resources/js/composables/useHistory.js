import { ref } from 'vue'
import axios from 'axios'

const calculations = ref([])

async function getCalculations() {
    try {
        const response = await axios.get('/api/calculations')
        calculations.value = response.data
    } catch (error) {
        console.error(error)
    }
}

const copyCalculationInput = (calculation) => {
    input.value = calculation.input
}

async function deleteCalculation(id) {
    try {
        await axios.delete(`/api/calculations/${id}`)
        await getCalculations()
    } catch (error) {
        console.error(error)
    }
}

async function destroyCalculations() {
    try {
        await axios.delete('/api/calculations')
        await getCalculations()
    } catch (error) {
        console.error(error)
    }
}

export const useHistory = () => {
    return {
        calculations,
        getCalculations,
        copyCalculationInput,
        deleteCalculation,
        destroyCalculations
    }
}
