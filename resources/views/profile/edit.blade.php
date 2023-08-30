@extends('layout')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Profile') }}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Mot de passe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">
                                Supprimer mon compte
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded="false">Image de profil</a>
                        </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                            <div class="row">
                                <div class="col-12">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                            <p>
                                Souhaitez-vous supprimer votre compte ?
                            </p>
                            <form action="{{route('profile.destroy')}}" method="post">
                                @csrf
                                @method('delete')
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="password">Confirmer votre mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Votre mot de passe" aria-invalid="false">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                            <form action="{{ route('profile.upload.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <label>Votre image de profil</label>
                                    <input type="file" name="profile_image">
                                </fieldset>
                                <button type="submit" class=" btn btn-primary">Sauvegarder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
