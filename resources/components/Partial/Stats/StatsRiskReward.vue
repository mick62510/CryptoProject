<template>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title" v-if="isValid">Risk Reward Validé</h4>
                <h4 class="card-title" v-else>Risk Reward Objectif</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">Minimum</div>
                    <div class="col">{{ minData }}</div>
                </div>
                <div class="row">
                    <div class="col" v-if="isValid">% de réussite</div>
                    <div class="col" v-else>Médiane</div>
                    <div class="col"><span class="text-bold-700">{{ medianData }}</span></div>
                </div>
                <div class="row">
                    <div class="col">Maximum</div>
                    <div class="col">{{ maxData }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "StatsRiskReward",
    props: {
        routeData: { type: String, required: true },
        filters: { type: Object, required: true },
        isValid: { type: Boolean, required: true }
    },
    data() {
        return {
            minData: null,
            medianData: null,
            maxData: null,
        }
    },
    watch: {
        filters: {
            handler: function (val, oldVal) {
                if (JSON.stringify(val) !== JSON.stringify(oldVal)) {
                    this.initData(this.routeData, val);
                }
            },
            deep: true,
        },
    },
    methods: {
        initData: function (url, params = {}) {
            params.valid = this.isValid;
            axios.get(url, { params: params })
                .then((response) => {
                    this.minData = response.data.min;
                    this.medianData = response.data.median;
                    this.maxData = response.data.max;
                })
        },
    },
    created() {
        this.initData(this.routeData);
    },
}
</script>

<style scoped>

</style>
