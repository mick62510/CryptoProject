<template>
    <div v-if="loaded" class="container-chart-line">
        <Line :data="radarData" :options="options"></Line>
    </div>
</template>

<script>
import {Line} from 'vue-chartjs'
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
} from 'chart.js';

import axios from "axios";

export default {
    name: "ChartLine",
    components: {Line},
    props: {
        routeData: {type: String, required: true},
        filters: {type: Object, required: true},
    },
    data() {
        return {
            options: null,
            loaded: false,
            radarData: null
        }
    },
    watch: {
        filters: {
            handler: function (val) {
                this.initData(this.routeData, val);
            },
            deep: true,
        },
    },
    methods: {
        initData: function (url, params = {}) {
            axios.get(url, {params: params})
                .then((response) => {
                    this.radarData = response.data.data;
                    this.options = response.data.options;

                    ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend);

                    this.loaded = true;
                })
        },
    },
    created() {
        this.loaded = false

        try {
            this.initData(this.routeData)
        } catch (e) {
            console.error(e)
        }
    },
}
</script>

<style scoped>

</style>
