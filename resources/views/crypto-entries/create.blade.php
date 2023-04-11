@extends('layout')

@section('content')
    <section class="row">
        <div class="col-12">
            <h2 class="h2">Formulaire entré crypto</h2>
            <form action="{{route('crypto.entries.store')}}" method="POST">
                @include('crypto-entries.partial.form')
            </form>
        </div>
    </section>

@endsection

@push('js')
    @vite('resources/js/form-file.js')
@endpush
