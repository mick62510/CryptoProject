import {createApp} from "vue/dist/vue.esm-bundler";
import Grid from '../components/Grid.vue'

createApp()
    .component('Grid', Grid)
    .mount('#app');
