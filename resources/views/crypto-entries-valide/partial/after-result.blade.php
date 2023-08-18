<div class="card">
    <div class="card-content">
        <div class="card-body border-top-blue-grey border-top-lighten-5 ">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-primary">Formulaire Validation</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        <label>
                            Résultat :
                            <select class="form-control" name="result" id="result">
                                <option disabled selected></option>
                                @foreach ($casts['result'] as $id => $title)
                                    <option value="{{$id}}"
                                            @if( old('result') === $id) selected @endif>{{$title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </fieldset>
                </div>
                <fieldset class="form-group">
                    <label>
                        <fieldset class="form-group">RR validé :
                            <input type="number" class="form-control" name="risk_reward_valid" id="risk_reward_valid" placeholder="0.00"
                                   value="{{ old('risk_reward_valid') ? old('risk_reward_valid') : $model->risk_reward_valid}}">
                        </fieldset>

                    </label>
                </fieldset>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <fieldset class="form-group">Commentaire après résultat
                        <textarea class="form-control border border-1" name="text_after_result" rows="3"
                                  placeholder="Aucun texte">{{old('text_after_result')}}</textarea>
                    </fieldset>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <fieldset class="form-group">
                        Image après résultat
                        <span class="alert alert-danger hidden"></span>
                        <div class="custom-file">
                            <input type="text" name="image_after_result" class="hidden input-file">
                            <input type="file" class="custom-file-input"
                                   data-upload-ajax="{{route('crypto.entries.valide.ajax-upload')}}">
                            <label class="custom-file-label" for="image_after_result"
                                   aria-describedby="image_after_result">
                                Choose file
                            </label>
                            <div class="preview h-50">
                                <img src="#" class="hidden w-25">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        $(document).ready(function(){
            $('#result').change(function (){
                let val = $('#result').find(":selected").val();
                let rrval = 1;

                if(val === 'loose') {
                    rrval = -1;
                } else if (val === 'be') {
                    rrval = 0;
                }
                $('#risk_reward_valid').val(rrval)
            })
        });
    </script>
@endpush
