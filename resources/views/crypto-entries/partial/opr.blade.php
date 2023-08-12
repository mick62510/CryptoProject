<?php
/** @var \App\Models\CryptoEntries $model */
$opr = $model->opr()?->first();
$bullishBreakout = $opr?->bullish_breakout ?: null;
$bearishBreakout = $opr?->bearish_breakout ?: null;
$integration = $opr?->integration ?: null;
?>
<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>OPR cassure haussière</label>
                    <fieldset>
                        @foreach ($casts['opr']['bullish_breakout'] as $id => $title)
                            <div class="d-inline-block custom-control custom-checkbox mr-1">
                                <input type="radio" name="bullish_breakout" value="{{$id}}"
                                       @if(old('bullish_breakout') ? old('bullish_breakout') === $id : $bullishBreakout === $id) checked @endif>
                                <label for="bullish_breakout">{{$title}}</label>
                            </div>
                        @endforeach
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>OPR cassure baissière</label>
                    <fieldset>
                        @foreach ($casts['opr']['bearish_breakout'] as $id => $title)
                            <div class="d-inline-block custom-control custom-checkbox mr-1">
                                <input type="radio" name="bearish_breakout" value="{{$id}}"
                                       @if(old('bearish_breakout') ? old('bearish_breakout')  === $id : $bearishBreakout === $id) checked @endif>
                                <label for="bearish_breakout">{{$title}}</label>
                            </div>
                        @endforeach
                    </fieldset>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <label>OPR intégration</label>
                    <fieldset>
                        @foreach ($casts['opr']['integration'] as $id => $title)
                            <div class="d-inline-block custom-control custom-checkbox mr-1">
                                <input type="radio" name="integration" value="{{$id}}"
                                       @if(old('integration') ? old('integration') === $id :$integration === $id ) checked @endif>
                                <label for="integration">{{$title}}</label>
                            </div>
                        @endforeach
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

