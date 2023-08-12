import {createApp} from "vue/dist/vue.esm-bundler";
import FormEntries from "../components/CryptoEntries/FormEntries.vue";

createApp()
    .component('FormEntries', FormEntries)
    .mount('#app');
