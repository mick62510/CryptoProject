<template>
    <section class="row mt-75">
        <div class="col-12 border border-primary overflow-auto pb-50 pt-50">
            <h3>Filtres disponibles</h3>
            <div class="row mt-75">
                <div v-for="filter in filters">
                    <div class="col">
                        <grid-filter-select :filter="filter" v-if="filter.type === 'select'"
                                            @change="selectChange($event)"></grid-filter-select>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import GridFilterSelect from "./GridFilterSelect.vue";

export default {
    name: "GridFilter",
    components: {GridFilterSelect},
    props: {
        filters: {type: Object, required: true},
    },
    methods: {
        selectChange(event) {
            let value = event.target.value;
            let idSelect = event.target.name;

            this.$emit('update', idSelect, value);
        },
    },
}
</script>

<style scoped>

</style>
