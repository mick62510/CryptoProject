<template>
    <section>
        <dashboard-filter></dashboard-filter>
        <section>
            <div class="row border border-primary">
                <div class="col-12">
                    Filters :
                    <select2-actif :route-data-actif="routeDataActif" @update="updateFilters"></select2-actif>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <ChartRadar :route-data="routeActifRadar" :filters="filters"></ChartRadar>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <chart-doughnut :route-data="routeDoughnutWinLoose" :filters="filters"></chart-doughnut>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <chart-line :route-data="routeLineNumberEntries" :filters="filters"></chart-line>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <stats-risk-reward :route-data="routeRatioRiskReward" :filters="filters"></stats-risk-reward>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
import DashboardFilter from "./dashboardFilter.vue";
import ChartRadar from "../Partial/Chart/ChartRadar.vue";
import ChartDoughnut from "../Partial/Chart/ChartDoughnut.vue";
import StatsRiskReward from "../Partial/Stats/StatsRiskReward.vue";
import ChartLine from "../Partial/Chart/ChartLine.vue";
import Select2Actif from "../Partial/Select2Actif.vue";

export default {
    name: "dashboard",
    components: {Select2Actif, ChartLine, StatsRiskReward, ChartDoughnut, ChartRadar, DashboardFilter},
    props: {
        routeActifRadar: {type: String, required: true},
        routeDoughnutWinLoose: {type: String, required: true},
        routeRatioRiskReward: {type: String, required: true},
        routeLineNumberEntries: {type: String, required: true},
        routeDataActif: {type: String, required: true},
    },
    data() {
        return {
            filters: {
                actif: {},
            },
        }
    },
    methods: {
        updateFilters(data) {
            let filter = data.filter;
            let values = data.values;

            if (filter in this.filters) {
                this.filters[filter] = values;
            }
        },
    },
}
</script>

<style scoped>

</style>
