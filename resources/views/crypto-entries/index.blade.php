@extends('layout')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('home')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Gestion de vos données
    </li>
    <li class="breadcrumb-item active">Liste des entrées Crypto non validées
    </li>
@endsection

@section('content')

    <Grid :config="{{$config}}" :route-data="{{json_encode(route('crypto.entries.ajaxGridData'))}}"
          title="Liste des entrées Crypto"></Grid>
@endsection

@push('js')
    @vite('resources/js/grid.js')
@endpush
