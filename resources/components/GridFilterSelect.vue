<template>
    <fieldset class="form-group">
        <span class="label">{{ filter.label }}</span>
        <select class="form-control" :name="filter.id">
            <option selected></option>
            <option v-for="(value,key) in filter.values" :value="key">{{ value }}</option>
        </select>
    </fieldset>
</template>

<script>
export default {
    name: "GridFilterSelect",
    props: {
        filter: {type: Object, required: true},
    },
}
</script>

<style scoped>

</style>
