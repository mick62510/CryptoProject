<?php
/** @var \App\Models\CryptoEntries $model */
$data = $model->data()?->first();
$file = $data?->image_before_result;
$text = $data?->text_before_result;
?>
<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <fieldset class="form-group">Commentaire avant résultat
                        <textarea class="form-control border border-1" name="text_before_result" rows="3"
                                  placeholder="Aucun texte">{{old('text_before_result') ? old('text_before_result') : $text}}</textarea>

                    </fieldset>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        Image avant résultat
                        <span class="alert alert-danger hidden"></span>
                        <div class="custom-file">
                            <input type="text" name="image_before_result" class="hidden input-file">
                            <input type="file" class="custom-file-input"
                                   data-upload-ajax="{{route('crypto.entries.ajax-upload')}}">
                            <label class="custom-file-label" for="image_before_result"
                                   aria-describedby="image_before_result">
                                Choose file
                            </label>
                            <div class="preview h-50">
                                <img src="{{ $file ? asset('storage/' . $file) : '#' }}"
                                     class=" {{ $file ? '' : 'hidden' }} w-25">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
