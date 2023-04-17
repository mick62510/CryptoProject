@extends('base')
@section('body')
    <body
        class="vertical-layout vertical-menu-modern vertical-collapsed-menu 1-column  bg-full-screen-image menu-collapsed blank-page"
        data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    </body>
@endsection

