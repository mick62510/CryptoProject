<?php
/** @var \App\Models\CryptoEntries $model */
$analyze = $model->analyze()->first();
?>

<div class="col">
    <div class="col-12 text-md-left text-center">
        <span class="text-bold-700 text-primary">Analyze</span>
    </div>
    <div class="col-12">
        double_bot :
        <strong>{{$analyze->double_bot ?: '-'}}</strong>
    </div>
    <div class="col-12">
        double_top :
        <strong>{{$analyze->double_top ?: '-'}}</strong>
    </div>
    <div class="col-12">
        divergence :
        <strong>{{$analyze->divergence ?: '-'}}</strong>
    </div>
    <div class="col-12">
        bulle :
        <strong>{{$analyze->bulle ?: '-'}}</strong>
    </div>
</div>
