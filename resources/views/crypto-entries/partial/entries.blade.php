<?php
/** @var \App\Models\CryptoEntries $model */
$date = $model->date ?: now();
$date = old('date') ?: $date;
$actif = $model->actif()?->first();
$actifCode = $actif?->code;
$trend = $model->trend;
?>
<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Date et Heure
                            <input type="datetime-local" class="form-control" name="date"
                                   value="{{ $date }}">
                        </label>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Actif
                            <select class="form-control" name="actif_code">
                                <option disabled selected></option>
                                @foreach ($casts['actif'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if(old('actif_code') ? old('actif_code') === $id : $actifCode === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>Type</label>
                    <fieldset>
                        @foreach ($casts['entries']['trend'] as $id => $title)
                            <div class="d-inline-block custom-control custom-checkbox mr-1">
                                <input type="radio" name="trend" value="{{$id}}"
                                       @if(old('trend') ? old('trend') === $id : $trend === $id) checked @endif>
                                <label for="trend">{{$title}}</label>
                            </div>
                        @endforeach
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            <label>Tendance</label>
                            <select class="form-control" name="trend_type">
                                <option disabled selected></option>
                                @foreach ($casts['entries']['trend_type'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if(old('trend_type') ? old('trend_type') === $id : $model->trend_type === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <fieldset class="form-group">RR
                        <input type="number" class="form-control" name="risk_reward" placeholder="0.00"
                               value="{{ old('risk_reward') ? old('risk_reward') : $model->risk_reward}}">
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
