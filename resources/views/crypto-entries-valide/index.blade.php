@extends('layout')
@push('css')
    @vite('resources/css/vendor/photoswipe-skin.css')
@endpush

@section('content')
    <Grid :config="{{$config}}" :route-data="{{json_encode(route('crypto.entries.valide.ajaxGridData'))}}"
          title="Liste des entrées Crypto"></Grid>
@endsection

@push('js')
    @vite('resources/js/new-grid.js')
@endpush
