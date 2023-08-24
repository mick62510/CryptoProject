<template>
    <div class="col-sm-12 col-md-2">
        <fieldset>
            <label>
                Par Date :
            </label>
            <Multiselect v-model="value" :options="options" @change="change"/>
        </fieldset>
        <fieldset v-if="value === 'year'">
            <label>Par Année</label>
            <Multiselect v-model="valueOption" :options="fieldOptionsYears" @update:model-value="submit"/>
        </fieldset>
        <fieldset v-if="value === 'month'">
            <label>Par mois</label>
            <VueDatePicker v-model="valueOption" :teleport="true" :auto-position="false" locale="fr"
                           :max-date="maxDate" month-picker auto-apply @update:model-value="submit"/>
        </fieldset>
        <fieldset v-if="value === 'between'">
            <label>Entre deux dates : <small>Max. 30jours</small></label>
            <VueDatePicker v-model="valueOption" range min-range="1" :teleport="true" locale="fr"  :max-date="maxDateBetween"
                           :enable-time-picker="false" :auto-position="false" auto-position max-range="31" auto-apply
                           @update:model-value="submit"/>
        </fieldset>
    </div>
</template>
<script setup>
import { ref,computed } from 'vue';
import { addMonths, getMonth, getYear, subMonths } from 'date-fns';

const date = ref(new Date());
// 2 months before and after the current date
const maxDate = computed(() => addMonths(new Date(getYear(new Date()), getMonth(new Date())), 1));
const maxDateBetween = computed(() => addMonths(new Date(getYear(new Date()), getMonth(new Date())), 1));
</script>

<script>
import Multiselect from '@vueform/multiselect'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {
    name: "FilterDate",
    components: {Multiselect, VueDatePicker},
    props: {
        fieldNow: {type: Number, required: true},
        fieldOptionsYears: {type: Array, required: true}
    },
    data() {
        return {
            value: 'year',
            options: {year: 'Par Année', month: 'Par mois', between: 'Entre deux dates'},
            optionsYears: {},
            valueOption: '',
        }
    },
    methods: {
        change(value) {
            this.value = value

            if (value === 'month') {
                this.valueOption = new Date().getMonth()
            } else if (value === 'between') {
                const startDate = new Date();
                const endDate = new Date(new Date().setDate(startDate.getDate() - 7));
                this.valueOption = [startDate, endDate];
            }
        },
        submit() {
            this.$emit('update', {filter: 'date', values: {type:this.value,value:this.valueOption}});
        }
    },
    created() {
        this.valueOption = this.fieldNow
        this.$emit('update', {filter: 'date', values: {type: this.value, value: this.fieldNow}});
    }
}
</script>


<style scoped>

</style>
