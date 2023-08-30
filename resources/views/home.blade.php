@extends('layout')

@section('content')
    <dashboard :route-actif-radar="{{json_encode(route('crypto.ajax.dashboard.radar-actif'))}}"
               :route-doughnut-win-loose="{{json_encode(route('crypto.ajax.dashboard.doughnut-win-loose'))}}"
               :route-ratio-risk-reward="{{json_encode(route('crypto.ajax.dashboard.ratio-risk-reward'))}}"
               :route-line-number-entries="{{json_encode(route('crypto.ajax.dashboard.line-number-entries'))}}"
               :route-line-rr-valides="{{json_encode(route('crypto.ajax.dashboard.line-rr-valides'))}}"
               :route-data-actif="{{json_encode(route('crypto.ajax.dashboard.data-actif'))}}"
               :route-cache="{{json_encode(route('crypto.ajax.dashboard.update-cache'))}}"
               :filters-cache="{{json_encode($filters)}}"
               :route-get-years="{{json_encode(route('crypto.ajax.dashboard.get-years'))}}"
    ></dashboard>

@endsection

@push('js')
    @vite('resources/js/select2.js')
    @vite('resources/js/dashboard.js')
@endpush

