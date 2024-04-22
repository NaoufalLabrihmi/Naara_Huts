@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px ">
                <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20" style="background-image: url({{ URL::to('frontend/assets/img/inner-banner/chloe_NOMADE_03.jpg') }})">
                    <a href="" style="padding-top: 5rem !important;padding-bottom: 2rem">
                        <img alt="Logo" src="{{ URL::to('frontend/assets/img/inner-banner/nara-logo-2022.png') }}" class="theme-light-show h-70px h-lg-80px">
                    </a>
                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">
                        Welcome to Subscribers</h1>
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                        Reset Your Password Now and Back Up your Data

                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <form class="form w-100" novalidate="novalidate" data-kt-redirect-url="/confirm/password" id="kt_new_password_form">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Setup New Password</h1>
                            <div class="text-gray-400 fw-semibold fs-4">
                                Already have reset your password ?
                                <a href="{{ route('register/form') }}" class="link-primary fw-bold">
                                    Sign in here
                                </a>
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
                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Enter Password" autocomplete="off">
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-2"></i>
                                        <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                            </div>
                            <div class="text-muted">
                                Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bold text-dark fs-6">Confirm Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="confirm-password" placeholder="Enter Confirm Password" autocomplete="off">
                        </div>
                        <div class="fv-row mb-10">
                            <div class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1">
                                <label class="form-check-label fw-semibold text-gray-700 fs-6">
                                    I Agree &
                                    <a href="#" class="ms-1 link-primary">Terms and conditions</a>.
                                </label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bold">
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
            <!--Footer-->

            <!--end::Footer-->
        </div>
    </div>

    @section('script')
    <script>
        // Class Definition
        var KHAuthNewPassword = function() {
            // Elements
            var form;
            var submitButton;
            var validator;
            var passwordMeter;

            var handleForm = function(e) {
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form, {
                        fields: {
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
                            'confirm-password': {
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
                    }
                );

                submitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    validator.revalidateField('password');

                    validator.validate().then(function(status) {
                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            // Disable button to avoid multiple click
                            submitButton.disabled = true;
                            // route name url
                            var url = "{{ route('reset/password') }}"; // route name url
                            var forms = $('#kt_new_password_form'); // Prepare form data
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
                                        submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                        submitButton.disabled = false; // Enable button
                                        Swal.fire({
                                            text: "You have successfully reset your password!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            },
                                        }).then(function(success) {
                                            var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
                                        });
                                    }, );
                                } else {
                                    console.log(response);
                                    if (response.response_code == 401) {
                                        submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                        submitButton.disabled = false; // Enable button
                                        Swal.fire({
                                            text: "Sorry, invalid token, please try again.",
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
                                            text: "Sorry, the email or password is incorrect, please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                }
                            });
                        } else {
                            submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                            submitButton.disabled = false; // Enable button
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

                form.querySelector('input[name="password"]').addEventListener('input', function() {
                    if (this.value.length > 0) {
                        validator.updateFieldStatus('password', 'NotValidated');
                    }
                });
            }

            var validatePassword = function() {
                return (passwordMeter.getScore() === 100);
            }

            // Public Functions
            return {
                // public functions
                init: function() {
                    form = document.querySelector('#kt_new_password_form');
                    submitButton = document.querySelector('#kt_new_password_submit');
                    passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));
                    handleForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KHAuthNewPassword.init();
        });
    </script>

    @endsection
    @endsection