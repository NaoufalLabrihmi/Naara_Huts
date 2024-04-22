@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="d-flex flex-row-fluid flex-column flex-column-fluid text-center p-10 py-lg-20">
            <a href="{{ url('/') }}" class="pt-lg-20 mb-12">
                <img alt="Logo" src="{{ URL::to('frontend/assets/img/inner-banner/nara-logo-2022.png') }}" class="theme-light-show h-70px h-lg-80px">
            </a>
            <h1 class="fw-bold fs-2qx text-gray-800 mb-7">Password is changed</h1>
            <div class="fw-semibold fs-3 text-muted mb-15">
                Your password is successfully changed. Please Sign <br>
                in to your account and start a new Booking cicle.
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg fw-bold">Sign In</a>
            </div>
            <div class="text-gray-700 fw-semibold fs-4 pt-7">Did't receive an email?
                <a href="{{ route('forgot/password') }}" class="text-primary fw-bold">Try Again</a>
            </div>
        </div>
        <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-150px min-h-lg-350px" style="background-image: url(../../assets/media/illustrations/dozzy-1/7.png)">
        </div>
    </div>
</div>
@endsection