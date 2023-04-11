<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
          content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>2 Columns - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin Dashboard</title>
    <link rel="apple-touch-icon" href="{{Vite::asset('resources/images/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{Vite::asset('resources/images/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    @vite(['resources/css/vendor/material-vendors.min.css',
'resources/css/vendor/material.css','resources/css/vendor/components.css','resources/css/vendor/bootstrap-extended.css',
'resources/css/vendor/material-extended.css','resources/css/vendor/material-colors.css','resources/css/vendor/material-vertical-menu-modern.css',
'resources/css/app.scss',
])
    @stack('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern material-vertical-layout material-layout vertical-collapsed-menu 2-columns   menu-collapsed fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ url('home') }}">
                        <img class="brand-logo" alt="modern admin logo"
                             src="{{Vite::asset('resources/images/logo.png')}}">
                        <h3 class="brand-text">Modern</h3>
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
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('layout.footer')

@vite('resources/js/vendor/unison.js')
@vite(['resources/js/vendor/app-menu.js','resources/js/vendor/material-app.js'])
@vite('resources/js/vendor/app.js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>

@vite('resources/js/vendor/vendors.min.js')
@stack('js')

</body>

</html>
