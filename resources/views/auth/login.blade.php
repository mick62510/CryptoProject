@extends('layout-guest')


@section('content')
    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div class="p-1"><img src="{{Vite::asset('resources/images/logo-dark.png')}}"
                                                  alt="branding logo"></div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>Connexion</span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if ($errors->any())
                                @include('crypto-entries.partial.errors')
                            @endif
                            <form class="form-horizontal form-simple" action="{{ route('login') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input class="form-control" id="email" name="email" placeholder="Email" type="email"
                                           required>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Mot de passe" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-12 text-center text-sm-left">
                                        <fieldset>
                                            <input type="checkbox" id="remember" name="remember" class="chk-remember">
                                            <label for="remember-me"> Souviens-toi de moi</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-6 col-12 text-center text-sm-right">
                                        <a href="{{ route('password.request') }}" class="card-link">Mot de passe oublié
                                            ?</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-block"><i class="ft-unlock"></i> Se
                                    connecter
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="">
                            <p class="float-xl-right text-center m-0">
                                <a href="{{route('register')}}" class="card-link">Créer un nouveau compte ?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
