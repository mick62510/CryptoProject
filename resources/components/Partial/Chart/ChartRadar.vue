<template>
    <div v-if="loaded" class="container-chart-line">
        <Radar :data="radarData" :options="options" style="margin: 0 auto;"></Radar>
    </div>
</template>

<script>
import {Radar} from 'vue-chartjs'
import {Chart as ChartJS, RadialLinearScale, PointElement, LineElement, Filler, Tooltip, Legend} from 'chart.js';

import axios from "axios";

export default {
    name: "ChartRadar",
    components: {Radar},
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
            immediate: true,
            deep: true,
            handler: function (val,oldVal) {
               if(val.actif && val.actif.length === 0){
                    this.initData(this.routeData, val);
                }else if (val.actif && val.actif.length < 3) {
                    this.loaded = false;
                } else {
                    this.initData(this.routeData, val);
                }
            }
        },
    },
    methods: {
        initData: function (url, params = {}) {
            axios.get(url, {params: params})
                .then((response) => {
                    this.radarData = response.data.data;
                    this.options = response.data.options;

                    ChartJS.register(RadialLinearScale, PointElement, LineElement, Filler, Tooltip, Legend);

                    this.loaded = true;
                })
        },
    },
    created() {
        this.loaded = false

        try {
            this.initData(this.routeData,this.filters)
        } catch (e) {
            console.error(e)
        }
    }
}
</script>

<style scoped>

</style>
