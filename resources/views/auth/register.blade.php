@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px ">
                <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20" style="background-image: url({{ URL::to('frontend/assets/img/inner-banner/chloe_NOMADE_03.jpg') }})">
                    <a href="{{url('/')}}" style="padding-top: 5rem !important;padding-bottom: 2rem">
                        <img alt="Logo" src="{{ URL::to('frontend/assets/img/inner-banner/nara-logo-2022.png') }}" class="theme-light-show h-70px h-lg-80px">
                    </a>
                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">
                        Welcome to Subscribers</h1>
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                        Join us and start your jurney in the number one<br>
                        site in the world

                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-600px p-10 p-lg-15 mx-auto">
                    <form class="form w-100" id="kt_sign_up_form" data-kt-redirect-url="/login" method="POST">
                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">Create an Account</h1>
                            <div class="text-gray-400 fw-semibold fs-4">
                                Already have an account?
                                <a href="{{ route('login') }}" class="link-primary fw-bold">
                                    Sign in here
                                </a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-semibold text-gray-400 fs-7 mx-2">OR</span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <div class="row fv-row mb-7">
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">First Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Enter first name" id="first_name" name="first_name" autocomplete="off">
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">Last Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Enter last name" name="last_name" autocomplete="off">
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bold text-dark fs-6">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder="Enter email" name="email" autocomplete="off">
                        </div>
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <div class="mb-1">
                                <label class="form-label fw-bold text-dark fs-6">Password</label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Enter password" name="password" autocomplete="off">
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-2"></i> <i class="ki-duotone ki-eye fs-2 d-none"></i> </span>
                                </div>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                            </div>
                            <div class="text-muted">
                                Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bold text-dark fs-6">Confirm Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Enter confirm password" name="confirm_password" autocomplete="off">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1">
                                <span class="form-check-label fw-semibold text-gray-700 fs-6">
                                    I Agree <a href="#" class="ms-1 link-primary">Terms and conditions.</a>
                                </span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="button" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@section('script')
<script type="text/javascript">
    // Class definition
    var KHSignupGeneral = function() {
        // Elements
        var form;
        var submitButton;
        var validator;
        var passwordMeter;

        // Handle form
        var handleForm = function(e) {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            validator = FormValidation.formValidation(form, {
                fields: {
                    'first_name': {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            }
                        }
                    },
                    'last_name': {
                        validators: {
                            notEmpty: {
                                message: 'Last Name is required'
                            }
                        }
                    },
                    'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'The value is not a valid email address',
                            },
                            notEmpty: {
                                message: 'Email address is required'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            callback: {
                                message: 'Please enter valid password',
                                callback: function(input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm_password': {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    'toc': {
                        validators: {
                            notEmpty: {
                                message: 'You must accept the terms and conditions'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '', // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            });

            // Handle form submit using ajax
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                validator.revalidateField('password');
                validator.validate().then(function(status) {
                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        // Disable button to avoid multiple click
                        submitButton.disabled = true; // Simulate ajax request

                        // route name url
                        var url = "{{ route('register/save') }}"; // route name url
                        var forms = $('#kt_sign_up_form'); // Prepare form data
                        var data = $(forms).serialize();
                        $.ajax({
                            type: 'POST',
                            dataType: 'JSON',
                            url: url,
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.response_code == 200) {
                                    setTimeout(function(time) {
                                        submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                        submitButton.disabled = false; // Enable button
                                        Swal.fire({
                                            text: "You have successfully sign up!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            },
                                        }).then(function(redirect) {
                                            var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
                                        });
                                    }, );
                                } else {
                                    if (response.response_code == 400) {
                                        submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                        submitButton.disabled = false; // Enable button
                                        Swal.fire({
                                            text: "Sorry, your account register is ready, please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    } else {
                                        submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                        submitButton.disabled = false; // Enable button
                                        Swal.fire({
                                            text: "Sorry, looks like there are some errors detected, please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                }
                            },
                            error: function(response) {
                                submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                submitButton.disabled = false; // Enable button
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
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
                        // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
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

            // Handle password input
            form.querySelector('input[name="password"]').addEventListener('input', function() {
                if (this.value.length > 0) {
                    validator.updateFieldStatus('password', 'NotValidated');
                }
            });
        }

        // Password input validation
        var validatePassword = function() {
            return (passwordMeter.getScore() === 100);
        }
        // Public functions
        return {
            // Initialization
            init: function() {
                // Elements
                form = document.querySelector('#kt_sign_up_form');
                submitButton = document.querySelector('#kt_sign_up_submit');
                passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));
                handleForm();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KHSignupGeneral.init();
    });
</script>
@endsection
@endsection
