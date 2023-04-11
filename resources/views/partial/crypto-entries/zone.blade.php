<?php
/** @var \App\Models\CryptoEntries $model */
$zone = $model->zone()->first();
?>

<div class="col">
    <div class="col-12 text-md-left text-center">
        <span class="text-bold-700 text-primary">Zone</span>
    </div>
    <div class="col-12">
        zone_d :
        <strong>{{$zone->zone_d ? $zone->zone_d ? 'Oui' : 'Non': '-'}}</strong>
    </div>
    <div class="col-12">
        zone_h4 :
        <strong>{{$zone->zone_h4 ? $zone->zone_h4 ? 'Oui' : 'Non': '-'}}</strong>
    </div>
    <div class="col-12">
        zone_h1 :
        <strong>{{$zone->zone_h1 ? $zone->zone_h1 ? 'Oui' : 'Non': '-'}}</strong>
    </div>
    <div class="col-12">
        zone_m30 :
        <strong>{{$zone->zone_m30 ?$zone->zone_m30 ? 'Oui' : 'Non': '-'}}</strong>
    </div>
</div>
