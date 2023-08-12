<template>
    <div class="col-sm-12 col-md-3" v-if="load">
        <Multiselect
            v-model="values"
            mode="tags"
            :close-on-select="false"
            :searchable="true"
            :create-option="false"
            :options="options"
            @select="change"
            @deselect="change"
        />
    </div>
</template>

<script>
import axios from "axios";
import Multiselect from '@vueform/multiselect'

//TODO IF BUG prod rm -rf node_moduels npm install
export default {
    name: "Select2Actif",
    components: {Multiselect},
    props: {
        routeDataActif: {type: String, required: true},
        defaultActifs: {type: Object, required: false},
    },
    data() {
        return {
            values: null,
            options: [],
            load: false,
        }
    },
    methods: {
        initData: function (url, params = {}) {
            axios.get(url, {params: params})
                .then((response) => {
                    this.options = response.data;
                    this.load = true;
                })
        },
        change() {
            this.$emit('update', {filter: 'actif', values: this.values});
        }
    },
    mounted() {
        this.values = this.defaultActifs;
        this.initData(this.routeDataActif);
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
