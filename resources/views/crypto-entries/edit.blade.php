@extends('layout')

@section('content')
    <section class="row">
        <div class="col-12">
            <h2 class="h2">Editer le formulaire entré crypto #{{$model->id}}</h2>
            <form action="{{route('crypto.entries.update')}}" method="POST">
                <input name="id" value="{{$model->id}}" type="hidden">
                @include('crypto-entries.partial.form')
            </form>
        </div>
    </section>

@endsection

@push('js')
    @vite('resources/js/form-file.js')
@endpush
