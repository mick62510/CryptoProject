import {createApp} from "vue/dist/vue.esm-bundler";
import Dashboard from '../components/Dashboard/dashboard.vue'

let Vue = createApp();

Vue.component('dashboard', Dashboard)
    .mount('#app');
