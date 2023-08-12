@extends('layout')
@section('content')

    <div>
        <h2>
            {{ __('Profile') }}
        </h2>
    </div>

    <div>
        <div class="mx-auto">
            <div class="p-4  bg-white shadow ">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

@endsection
