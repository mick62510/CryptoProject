<form action="{{route('crypto.entries.valide.store', ['id' => $model->id])}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    @if ($errors->any())
        @include('crypto-entries.partial.errors')
    @endif
    @include('crypto-entries-valide.partial.resume')
    @include('crypto-entries-valide.partial.after-result')

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
</form>
