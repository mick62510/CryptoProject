@extends('layout')

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <h2 class="h2">Formulaire Validation Entré Crypto</h2>
                @include('crypto-entries-valide.partial.form')
            </div>
        </div>
    </section>
@endsection

@push('js')
    @vite('resources/js/form-file.js')
    @vite('resources/js/image.js')
@endpush


