import './bootstrap';

import { createApp } from 'vue';
import Calculator from "./components/Calculator.vue";
import CalculatorHistory from "./components/CalculatorHistory.vue";

createApp({})
    .component('Calculator', Calculator)
    .component('CalculatorHistory', CalculatorHistory)
    .mount('#app');