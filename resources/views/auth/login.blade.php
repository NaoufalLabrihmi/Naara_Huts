@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">

                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">
                        Welcome Back</h1>
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                        Sign-in to get the best news<br>
                        in the world in one place

                    </p>
                </div>
                <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ URL::to('assets/media/illustrations/dozzy-1/17.png') }})"></div>
            </div>
        </div>
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="">
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Sign In</h1>
                            <div class="text-gray-400 fw-semibold fs-4">
                                New Here?
                                <a href="{{ route('register/form') }}" class="link-primary fw-bold">
                                    Create an Account
                                </a>
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bold text-dark">Email / Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email_phone" placeholder="Enter email or phone" autocomplete="off">
                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bold text-dark fs-6 mb-0">Password</label>
                                <a href="{{ route('forgot/password') }}" class="link-primary fs-6 fw-bold">Forgot Password ?</a>
                            </div>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Enter password" autocomplete="off">
                        </div>
                        <div class="text-center">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <div class="text-center text-muted text-uppercase fw-bold mb-5">or</div>
                            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                                <img alt="Logo" src="{{ URL::to('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3">
                                Continue with Google
                            </a>
                            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                                <img alt="Logo" src="{{ URL::to('assets/media/svg/brand-logos/facebook-4.svg') }}" class="h-20px me-3">
                                Continue with Facebook
                            </a>
                            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
                                <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-20px me-3">
                                <img alt="Logo" src="{{ URL::to('assets/media/svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-20px me-3">
                                Continue with Apple
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@section('script')


<script>
    var KHSigninGeneral = function() {
        var form;
        var submitButton;
        var validator;

        var handleValidation = function(e) {
            validator = FormValidation.formValidation(form, {
                fields: {
                    'email_phone': {
                        validators: {
                            notEmpty: {
                                message: 'Email or phone is required'
                            },
                            custom: {
                                message: 'Please enter a valid email or phone number',
                                validate: function(input) {
                                    const value = input.value;
                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    const phoneRegex = /^\d{10}$/;
                                    return emailRegex.test(value) || phoneRegex.test(value);
                                }
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '', // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            });
        }

        var handleSubmitAjax = function(e) {
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                validator.validate().then(function(status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        var url = "{{ route('login/push') }}";
                        var forms = $('#kt_sign_in_form');
                        var data = $(forms).serialize();
                        $.ajax({
                            type: 'POST',
                            dataType: 'JSON',
                            url: url,
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        }).then(function(response) {
                            if (response.response_code == 200) {
                                setTimeout(function(time) {
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                    Swal.fire({
                                        text: "You have successfully logged in!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                    }).then(function(success) {
                                        var redirectUrl = response.url;
                                        if (redirectUrl) {
                                            document.getElementById('kt_sign_in_form').setAttribute('data-kt-redirect-url', redirectUrl);
                                            location.href = redirectUrl;
                                        }
                                    });
                                });
                            } else if (response.response_code == 400) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                Swal.fire({
                                    text: "Sorry, the email or password is incorrect, please try again 400.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    } else {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                        Swal.fire({
                            text: "Sorry, the email or password is incorrect, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        }

        return {
            init: function() {
                form = document.querySelector('#kt_sign_in_form');
                submitButton = document.querySelector('#kt_sign_in_submit');
                handleValidation();
                handleSubmitAjax();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function() {
        KHSigninGeneral.init();
    });
</script>


@endsection
@endsection