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
                        Back up your data and <br>
                        Reset your password

                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <form class="form w-100" novalidate="novalidate" data-kt-redirect-url="/login" id="kt_password_reset_form">
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">
                                Forgot Password ?
                            </h1>
                            <div class="text-gray-400 fw-semibold fs-4">
                                Enter your email to reset your password.
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bold text-gray-900 fs-6">Email</label>
                            <input class="form-control form-control-solid" type="email" placeholder="Enter email" name="email" placeholder="Enter email" autocomplete="off">
                        </div>
                        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                            <button type="button" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bold me-4">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bold">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @section('script')

    <script>
        // Class Definition
        var KHAuthResetPassword = function() {
            // Elements
            var form;
            var submitButton;
            var validator;

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
                    }
                );

                submitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    validator.validate().then(function(status) { // Validate form
                        if (status == 'Valid') { // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on'); // Disable button to avoid multiple click
                            submitButton.disabled = true; // Simulate ajax request
                            var url = "{{ route('post/email') }}"; // route name url
                            var forms = $('#kt_password_reset_form'); // Prepare form data
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
                                                text: "We have send a password reset link to your email.",
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
                                        submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                        submitButton.disabled = false; // Enable button
                                        Swal.fire({
                                            text: "Sorry, the email is incorrect, please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                },
                                error: function(response) {
                                    submitButton.removeAttribute('data-kt-indicator'); // Hide loading indication
                                    submitButton.disabled = false; // Enable button
                                    Swal.fire({
                                        text: "Sorry, the email is incorrect, please try again.",
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
            }
            // Public Functions
            return {
                // public functions
                init: function() {
                    form = document.querySelector('#kt_password_reset_form');
                    submitButton = document.querySelector('#kt_password_reset_submit');
                    handleForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KHAuthResetPassword.init();
        });
    </script>

    @endsection
    @endsection