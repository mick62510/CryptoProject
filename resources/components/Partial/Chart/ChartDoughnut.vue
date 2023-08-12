<template>
    <div v-if="loaded">
        <doughnut :data="doughnutData" :options="options"></doughnut>
    </div>
</template>

<script>

import {Doughnut} from 'vue-chartjs'
import {Chart as ChartJS, ArcElement, Tooltip, Legend} from 'chart.js';


import axios from "axios";

export default {
    name: "ChartDoughnut",
    components: {Doughnut},
    props: {
        routeData: {type: String, required: true},
        filters: {type: Object, required: true},
    },
    data() {
        return {
            options: null,
            loaded: false,
            doughnutData: null,
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
                    this.doughnutData = response.data.data;
                    this.options = response.data.options;
                    ChartJS.register(ArcElement, Tooltip, Legend);
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
