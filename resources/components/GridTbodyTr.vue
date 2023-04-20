<template>
    <tr class=" cursor-pointer">
        <td v-for="td in this.tr.columns" :data-id="td.id"
            :class="td.id === 'id' && this.hasExtra ? 'extend-row' : ''" @click="this.show = !this.show">
            <span v-if="td.id === 'id' && this.hasExtra">
                <input :value="td.value" class="hidden">
                <i class="material-icons" v-if="this.show">remove</i>
                <i class="material-icons" v-else>add</i>
            </span>
            <span v-else>
                 {{ td.value }}
            </span>
        </td>
        <td>
            <div class="float-right">
                <span v-for="action in this.tr.actions" v-html="action" class="ml-1">
                </span>
            </div>
        </td>
    </tr>
    <grid-tbody-tr-extra v-if="hasExtra" :tr="this.tr.extraColumns" :id="this.tr.rowId" :index="index"
                         v-show="this.show"></grid-tbody-tr-extra>
</template>

<script>
import GridTbodyTrExtra from "./GridTbodyTrExtra.vue";

export default {
    name: "GridTbodyTr",
    components: {GridTbodyTrExtra},
    props: {
        tr: {type: Object, required: true},
        index: {type: Number, required: true},
    },
    data() {
        return {
            hasExtra: false,
            tdClass: '',
            show: false,
        }
    },
    created() {
        this.hasExtra = JSON.stringify(this.tr.extraColumns) !== JSON.stringify([]);

        if (this.hasExtra) {
            this.tdClass = 'extend-row';
        }
    }
}
</script>

<style scoped>

</style>
