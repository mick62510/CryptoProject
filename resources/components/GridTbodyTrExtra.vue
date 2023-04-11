<template>
    <tr class="extend-row" :data-id="this.id">
        <td colspan="6">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm" v-for="config in tr">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-bold-700 text-primary">{{ config.label }}</span>
                            </div>
                            <div class="col-12" v-for="row in config.rows">
                                {{ row.label }} :
                                <span v-if="row.ext && row.ext === 'image'" class="show-image">
                                    <br/>
                                      <a :href="row.value" class="open-image" target="_blank">
                                        <img :src="row.value" alt="" class="w-50">
                                    </a>
                                </span>
                                <strong v-html="row.value" v-else></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</template>
<script>

import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';
import photoswipe from 'photoswipe'

export default {
    name: "GridTbodyTrExtra",
    props: {
        tr: {type: Object, required: true},
        id: {type: Number, required: true}
    },
    created() {

    }, mounted() {
        const lightbox = new PhotoSwipeLightbox({
            gallery: '.show-image',
            children: 'a.open-image',
            mouseMovePan: true,
            pswpModule: () => photoswipe
        });
        lightbox.init();
    }
}
</script>

<style scoped>

</style>
