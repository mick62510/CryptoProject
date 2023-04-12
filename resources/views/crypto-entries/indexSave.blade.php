@extends('layout')


@section('content')
    <section class="row">
        <div class="col-12 overflow-auto">
            <h1 class="h1">Liste des entrées Crypto</h1>
            <table class="table">
                <thead class="bg-primary white">
                <tr>
                    <th>#</th>
                    <th>Date création</th>
                    <th>Actif</th>
                    <th>Trend</th>
                    <th>Trend Type</th>
                    <th>risk_reward</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var $item \App\Models\CryptoEntries */ ?>
                @foreach ($items as $item)
                    <tr>
                        <td class="extend-row">
                            <input value="{{$item->id}}" class="hidden">
                            <i class="material-icons">add</i>
                        </td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->actif()->first()?->code}}</td>
                        <td>{{$item->trend}}</td>
                        <td>{{$item->trend_type}}</td>
                        <td>{{$item->risk_reward}}</td>
                    </tr>
                    <tr class="hidden extend-row" data-id="{{$item->id}}">
                        <td colspan="6">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-bold-700 text-primary">OPR</span>
                                            </div>
                                            <div class="col-12">
                                                Bullish breakout :
                                                <strong>{{$item->opr()->first()->bullish_breakout ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                bearish_breakout :
                                                <strong>{{$item->opr()->first()->bearish_breakout ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                integration :
                                                <strong>{{$item->opr()->first()->integration ?: '-'}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-bold-700 text-primary">Zone</span>
                                            </div>
                                            <div class="col-12">
                                                zone_d :
                                                <strong>{{$item->zone()->first()->zone_d ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                zone_h4 :
                                                <strong>{{$item->zone()->first()->zone_h4 ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                zone_h1 :
                                                <strong>{{$item->zone()->first()->zone_h1 ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                zone_m30 :
                                                <strong>{{$item->zone()->first()->zone_m30 ?: '-'}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-bold-700 text-primary">Analyze</span>
                                            </div>
                                            <div class="col-12">
                                                double_bot :
                                                <strong>{{$item->analyze()->first()->double_bot ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                double_top :
                                                <strong>{{$item->analyze()->first()->double_top ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                divergence :
                                                <strong>{{$item->analyze()->first()->divergence ?: '-'}}</strong>
                                            </div>
                                            <div class="col-12">
                                                bulle :
                                                <strong>{{$item->analyze()->first()->bulle ?: '-'}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-bold-700 text-primary">Données avant résultat</span>
                                            </div>
                                            <div class="col-12">
                                                Texte :
                                                <strong>{{$item->data()->first()->text_before_result ?: '-'}}</strong>
                                            </div>
                                            @if($item->data()->first()->image_before_result)
                                                <div class="col-12 show-image">
                                                    <div>Image:</div>
                                                    <a href="{{asset('storage/'.$item->data()->first()->image_before_result)}}"
                                                       class="open-image" target="_blank">
                                                        <img
                                                            src="{{asset('storage/'.$item->data()->first()->image_before_result)}}"
                                                            alt="" class="w-50">
                                                    </a>
                                                </div>
                                            @else
                                                <div class="col-12">
                                                    image_before_result :
                                                    <strong>aucune image</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="float-right">
                {{ $items->links() }}
            </div>
        </div>
    </section>
@endsection

@push('js')
    @vite('resources/js/grid.js')
    @vite('resources/js/image.js')
@endpush
