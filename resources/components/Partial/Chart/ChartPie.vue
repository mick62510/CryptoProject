<template>
    <Pie :options="options" :route-data="routeData"/>
</template>

<script>
import {Pie} from "vue-chartjs";
import {Chart as ChartJS, ArcElement, Tooltip, Legend} from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
    name: "ChartPie",
    components: {Pie},
    props: {
        routeData: {type: String, required: true},
    },
    data() {
        return {
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    }
}
</script>

<style scoped>

</style>
