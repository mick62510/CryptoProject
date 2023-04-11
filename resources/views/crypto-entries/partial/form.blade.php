<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
@if ($errors->any())
    @include('crypto-entries.partial.errors')
@endif
@include('crypto-entries.partial.entries')
@include('crypto-entries.partial.opr')
@include('crypto-entries.partial.zone')
@include('crypto-entries.partial.analyze')
@include('crypto-entries.partial.before-result')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="ft-thumbs-up position-right"></i>
                        Valider le formulaire
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

