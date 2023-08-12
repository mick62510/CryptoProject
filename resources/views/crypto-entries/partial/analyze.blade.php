<?php
/** @var \App\Models\CryptoEntries $model */
$analyze = $model->analyze()?->first();
$double_bot = $analyze?->double_bot;
$double_top = $analyze?->double_top;
$divergence = $analyze?->divergence;
$bulle = $analyze?->bulle;
?>
<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Double bot
                            <select class="form-control" name="double_bot">
                                <option disabled selected></option>
                                @foreach ($casts['analyze']['double_bot'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if(old('double_bot') ?old('double_bot') === $id : $double_bot === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Double top
                            <select class="form-control" name="double_top">
                                <option disabled selected></option>
                                @foreach ($casts['analyze']['double_top'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if(old('double_top') ? old('double_top') === $id : $double_top === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Divergence
                            <select class="form-control" name="divergence">
                                <option disabled selected></option>
                                @foreach ($casts['analyze']['divergence'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if(old('divergence') ? old('divergence') === $id : $divergence === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Bulle
                            <select class="form-control" name="bulle">
                                <option disabled selected></option>
                                @foreach ($casts['analyze']['bulle'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if(old('bulle') ? old('bulle') === $id : $bulle === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
