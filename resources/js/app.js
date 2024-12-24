import './bootstrap';

import { createApp } from 'vue';
import IncrementCounter from './components/Calculator.vue';
import Calculator from "./components/Calculator.vue";

createApp({})
    .component('Calculator', Calculator)
    .mount('#app');