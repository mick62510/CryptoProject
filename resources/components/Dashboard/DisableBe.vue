<template>
    <div class="col-sm-12 col-md-3">
        Activer Be sur les données
        <Toggle v-model="value" @change="change"/>
    </div>
</template>

<script>

import Toggle from '@vueform/toggle'

export default {
    name: "DisableBe",
    components: {
        Toggle,
    },
    props: {
        defaultValue: {type: Boolean, default: true},
    },
    data() {
        return {
            value: true,
        }
    },
    methods: {
        change() {
            this.$emit('update', {filter: 'be', values: this.value});
        }
    },
    created() {
        this.value = this.defaultValue;
    }
}
</script>

<style src="@vueform/toggle/themes/default.css"></style>
