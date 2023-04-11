<?php
/** @var \App\Models\CryptoEntries $model */
$opr = $model->opr()->first();
?>

<div class="col">
    <div class="col-12 text-md-left text-center">
        <div class="text-bold-700 text-primary">OPR</div>
    </div>
    <div class="col-12">
        Bullish breakout :
        <strong>{{$opr->bullish_breakout ?: '-'}}</strong>
    </div>
    <div class="col-12">
        bearish_breakout :
        <strong>{{$opr->bearish_breakout ?: '-'}}</strong>
    </div>
    <div class="col-12">
        integration :
        <strong>{{$opr->integration ?: '-'}}</strong>
    </div>
</div>
