<?php
/** @var \App\Models\CryptoEntries $model */
$data = $model->data()->first();
?>


<div class="col">
    <div class="col-12 text-md-left text-center">
        <span class="text-bold-700 text-primary">Données avant résultat</span>
    </div>

    <div class="col-12">
        Texte :
        <strong>{{$data->text_before_result ?: '-'}}</strong>
    </div>
    @if($data->image_before_result)
        <div class="col-12 show-image">
            <div>Image:</div>
            <a href="{{asset('storage/'.$data->image_before_result)}}" class="open-image" target="_blank">
                <img src="{{asset('storage/'.$data->image_before_result)}}" alt="" class="w-50">
            </a>

        </div>
    @else
        <div class="col-12">
            image_before_result :
            <strong>aucune image</strong>
        </div>
    @endif
</div>
