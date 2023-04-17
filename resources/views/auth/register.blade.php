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
                                <span>Create your account</span>
                            </p>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('register') }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        @if($errors->get('name'))
                                            <div class="alert alert-danger">{{$errors->get('name')}}</div>
                                        @endif
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="User Name">
                                        <div class="form-control-position">
                                            <i class="la la-user"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        @if($errors->get('email'))
                                            <div class="alert alert-danger">{{$errors->get('email')}}</div>
                                        @endif
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Your Email Address" required>
                                        <div class="form-control-position">
                                            <i class="la la-envelope"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        @if($errors->get('password'))
                                            <div class="alert alert-danger">{{$errors->get('password')}}</div>
                                        @endif
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Enter Password" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        @if($errors->get('password_confirmation'))
                                            <div
                                                class="alert alert-danger">{{$errors->get('password_confirmation')}}</div>
                                        @endif
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation"
                                               placeholder="Confirmation Password" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-outline-info btn-block">
                                        <i class="la la-user"></i> Register
                                    </button>
                                </form>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block">
                                    <i class="ft-unlock"></i>Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
