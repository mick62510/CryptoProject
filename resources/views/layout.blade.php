@extends('base')


@section('body')
    <body
        class="vertical-layout vertical-menu-modern material-vertical-layout material-layout vertical-collapsed-menu 2-columns   menu-collapsed fixed-navbar"
        data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item mr-auto">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img class="brand-logo" alt="Mon-Journal-Trading logo"
                                 src="{{Vite::asset('resources/images/logo.png')}}">
                            <h3 class="brand-text">MonJournalTrading</h3>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block float-right nav-toggle">
                        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                            <i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i>
                        </a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <i class="material-icons mt-50">more_vert</i>
                        </a>
                    </li>
                </ul>
            </div>
            @include('layout.horizontal-nav')
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <!-- main menu-->
    @include('layout.vertical-nav')

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        @include('layout.breadcrumb')
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div id="app">
                    @include('layout.alert')
                    @yield('content')
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <div class="image-fullscreen">
                        <div class="image-fullscreen-gestion">
                            <div class="image-fullscreen-gestion-panel">
                                <button class="btn-image-close"><i class="material-icons">close</i></button>
                                <button class="btn-image-zoom-in"><i class="material-icons">zoom_in</i></button>
                                <button class="btn-image-zoom-out"><i class="material-icons">zoom_out</i></button>
                            </div>
                            <div class="image-fullscreen-gestion-image">
                                <img draggable="false"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @include('layout.footer')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
    @vite('resources/js/vendor/unison.js')
    @vite(['resources/js/vendor/app-menu.js','resources/js/vendor/material-app.js'])
    @vite('resources/js/vendor/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script><script> window.start.init({Palette:"palette6",Mode:"floating right",Theme:"wire",Location:"https://mon-journal-trading.fr/cookie-policy",Time:"10",})</script>
    @vite('resources/js/btn-confirmation.js')
    @vite('resources/js/image.js')
    @stack('js')
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ('serviceWorker' in navigator && !navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (registration) {
                // Registration was successful
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
            }, function (err) {
                // registration failed :(
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }
    </script>

    </body>
@endsection
