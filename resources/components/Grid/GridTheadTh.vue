<template>
    <th :class="column.display ?'': 'hidden'">
        {{ column.label }}
    </th>
</template>

<script>
export default {
    name: "GridTheadTh",
    props: {
        column: {type: Object, required: true},
    },
}
</script>

<style scoped>

</style>
