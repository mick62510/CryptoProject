<template>
    <h1 class="h1">Liste des entrées Crypto</h1>
    <grid-filter :filters="config.filters" v-if="config.filters" @update="updateFilter"></grid-filter>
    <section class="row mt-75">
        <div class="col-12 overflow-auto">
            <table class="table">
                <thead class="bg-primary white">
                <tr>
                    <th v-if="configHaskey('extra')"></th>
                    <grid-thead-th :column="column" v-for="column in config.columns"/>
                </tr>
                </thead>
                <tbody>
                <grid-tbody-tr v-for="tr in tbody" :tr="tr"></grid-tbody-tr>
                </tbody>
            </table>
            <Bootstrap5Pagination :data="this.pagination" align="right"
                                  @pagination-change-page="loadPage"></Bootstrap5Pagination>

        </div>
    </section>
</template>

<script>
import GridTheadTh from "./GridTheadTh.vue";
import GridFilter from "./GridFilter.vue";
import axios from "axios";
import GridTbodyTr from "./GridTbodyTr.vue";
import {Bootstrap5Pagination} from 'laravel-vue-pagination'

export default {
    name: "Grid",
    components: {GridTbodyTr, GridFilter, GridTheadTh, Bootstrap5Pagination},
    props: {
        config: {type: Object, required: true},
        title: {type: String, required: true},
        routeData: {type: String, required: true},
    },
    data() {
        return {
            tbody: {},
            globalSearch: '',
            orderBy: {},
            filtersValues: {},
            pagination: {},
        }
    },
    methods: {
        configHaskey(key) {
            return Object.keys(this.config).includes(key);
        },
        execRequest: function (url, params = {}) {
            axios.get(url, {params: params})
                .then((response) => {
                    this.tbody = response.data.rows;
                    this.pagination = response.data.pagination;
                })
        },
        updateFilter(idFilter, value) {
            if (idFilter in this.filtersValues) {
                delete this.filtersValues[idFilter];
            }

            if (value) {
                this.filtersValues[idFilter] = value;
            }

            this.loadPage(1);
        },
        loadPage: function (page) {
            this.execRequest(this.routeData, {
                page: page,
                search: this.globalSearch,
                filters: this.filtersValues,
                orderBy: this.orderBy,
            })
        },
    },
    created() {
        this.loadPage(1);
    }
}
</script>

<style scoped>

</style>
