<?php
/** @var \App\Models\CryptoEntries $model */
$zone = $model->zone()?->first();
$area_d = $zone?->area_d ?: null;
$area_h4 = $zone?->area_h4 ?: null;
$area_h1 = $zone?->area_h1 ?: null;
$area_m30 = $zone?->area_m30 ?: null;
?>
<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>Zone D</label>
                    <fieldset>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_d" value="1"
                                   @if(old('area_d') ? (bool)old('area_d') : (bool)$area_d) checked @endif>
                            <label for="area_d">Oui</label>
                        </div>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_d" value="0"
                                   @if(old('area_d') ? !old('area_d') : !$area_d) checked @endif>
                            <label for="area_d">Non</label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>Zone H4</label>
                    <fieldset>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_h4" value="1"
                                   @if(old('area_h4') ? (bool)old('area_h4') === true : (bool)$area_h4) checked @endif>
                            <label for="area_h4">Oui</label>
                        </div>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_h4" value="0"
                                   @if(old('area_h4') ? (bool)old('area_h4') === false : !$area_h4) checked @endif>
                            <label for="area_h4">Non</label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>Zone H1</label>
                    <fieldset>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_h1" value="1"
                                   @if(old('area_h1') ? (bool)old('area_h1') : (bool)$area_h1) checked @endif>
                            <label for="area_h1">Oui</label>
                        </div>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_h1" value="0"
                                   @if(old('area_h1') ? !old('area_h1') : !$area_h1) checked @endif>
                            <label for="area_h1">Non</label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>Zone M30</label>
                    <fieldset>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_m30" value="1"
                                   @if(old('area_m30') ? (bool)old('area_m30') === true : (bool)$area_m30) checked @endif>
                            <label for="area_m30">Oui</label>
                        </div>
                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                            <input type="radio" name="area_m30" value="0"
                                   @if(old('area_m30') ? !old('area_m30'): !$area_m30) checked @endif>
                            <label for="area_m30">Non</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
