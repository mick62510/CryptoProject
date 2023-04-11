<?php
/** @var \App\Models\CryptoEntries $model */
$opr = $model->opr()->first();
?>
<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-primary">Résumé avant validation</h3>
                </div>
            </div>
            <div class="row">
                @include('partial.crypto-entries.opr')
                @include('partial.crypto-entries.zone')
                @include('partial.crypto-entries.analyze')
                @include('partial.crypto-entries.data-before-result')
            </div>
        </div>
    </div>
</div>
