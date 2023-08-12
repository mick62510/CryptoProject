@extends('layout')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('home')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Gestion de vos données
    </li>
    <li class="breadcrumb-item active">Formulaire
    </li>
@endsection
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
