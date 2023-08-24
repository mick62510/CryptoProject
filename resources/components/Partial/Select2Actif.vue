<template>
    <div class="col-sm-12 col-md-3" v-if="load">
        <div class="form-group">
            <fieldset>
                <label>Actif:</label>
                <Multiselect
                    v-model="selectedValues"
                    mode="tags"
                    :close-on-select="false"
                    :searchable="true"
                    :create-option="false"
                    :options="options"
                    @select="handleSelect"
                    @deselect="handleDeselect"
                />
            </fieldset>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Multiselect from '@vueform/multiselect';

export default {
    name: "Select2Actif",
    components: { Multiselect },
    props: {
        routeDataActif: { type: String, required: true },
        defaultActifs: { type: Object, required: false }
    },
    data() {
        return {
            selectedValues: [],
            options: [],
            load: false
        };
    },
    methods: {
        initData: function (url, params = {}) {
            axios.get(url, { params: params })
                .then((response) => {
                    this.options = response.data;
                    this.load = true;
                });
        },
        handleSelect() {
            console.log('select')
            this.$emit('update', { filter: 'actif', values: this.selectedValues });
        },
        handleDeselect() {
            console.log('de-select')
            this.$emit('update', { filter: 'actif', values: this.selectedValues });
        }
    },
    beforeMount() {
        this.selectedValues = this.defaultActifs;
        this.initData(this.routeDataActif);
    }
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
