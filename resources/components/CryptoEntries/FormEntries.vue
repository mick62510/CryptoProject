<template>
    <div>
        <div class="col-xl-2 col-lg-6 col-md-12 hidden" id="fieldset-crypto">
            <fieldset class="form-group">
                <label>
                    Actif Crypto
                    <Multiselect style="min-width: 200px !important;" :options="cryptoOptions" v-model="crypto" nmode="single" no-options-text="Veuillez saisir votre données"
                                 :searchable="true" :create-option="true"/>
                </label>
            </fieldset>
        </div>
        <div class="col-xl-2 col-lg-6 col-md-12 hidden" id="fieldset-forex">
            <fieldset class="form-group">
                <label>
                    Actif Forex
                    <Multiselect style="min-width: 200px !important;" :options="forexOptions" v-model="forex" nmode="single" no-options-text="Veuillez saisir votre données"
                                 :searchable="true" :create-option="true"/>
                </label>
            </fieldset>
        </div>
        <input type="hidden" v-bind:value="crypto" name="actif_crypto"/>
        <input type="hidden" v-bind:value="forex" name="actif_forex"/>
    </div>
</template>
<script>
import Multiselect from '@vueform/multiselect'

export default {
    name: "FormEntries",
    components: {Multiselect},
    props: {
        casts: {required: true},
    },
    data() {
        return {
            cryptoOptions: [],
            forexOptions: [],
            crypto:'',
            forex:'',
        }
    },
    created() {
        this.forexOptions = this.casts['forex'];
        this.cryptoOptions = this.casts['crypto'];
    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
