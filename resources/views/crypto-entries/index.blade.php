@extends('layout')


@section('content')

    <Grid :config="{{$config}}" :route-data="{{json_encode(route('crypto.entries.ajaxGridData'))}}"
          title="Liste des entrées Crypto"></Grid>
@endsection

@push('js')
    @vite('resources/js/new-grid.js')
@endpush
