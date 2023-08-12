@extends('layout-guest')

@section('content')
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                        <div class="card-header border-0 pb-0">
                            <div class="card-title text-center">
                                <img src="{{Vite::asset('resources/images/logo.png')}}" alt="branding logo">
                            </div>
                        </div>
                        <div class="card-content">
                            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                <span>Créer un nouveau compte</span>
                            </p>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('register') }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    @if($errors->get('name'))
                                        <div class="alert alert-danger">{{$errors->get('name')}}</div>
                                    @endif
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}"
                                               placeholder="Prénom / Pseudo">
                                        <div class="form-control-position">
                                            <i class="la la-user"></i>
                                        </div>
                                    </fieldset>
                                    @if($errors->get('email'))
                                        <div class="alert alert-danger">{{$errors->get('email')[0]}}</div>
                                    @endif
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Email" value="{{old('email')}}" required>
                                        <div class="form-control-position">
                                            <i class="la la-envelope"></i>
                                        </div>
                                    </fieldset>
                                    @if($errors->get('password'))
                                        <div class="alert alert-danger">{{$errors->get('password')[0]}}</div>
                                    @endif
                                    <fieldset class="form-group position-relative has-icon-left">

                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Mot de passe" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                    </fieldset>
                                    @if($errors->get('password_confirmation'))
                                        <div
                                            class="alert alert-danger">{{$errors->get('password_confirmation')}}</div>
                                    @endif
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation"
                                               placeholder="Confirmation Mot de passe" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-outline-info btn-block">
                                        <i class="la la-user"></i> S'enregistrer
                                    </button>
                                </form>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block">
                                    <i class="ft-unlock"></i> Connexion
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
