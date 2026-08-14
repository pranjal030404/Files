@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-6">
                    <div class="d-flex justify-content-center">
                        <div class="verification-code-wrapper">
                            <div class="verification-area">
                                <div class="section__head pb-3 text-center">
                                    <h2 class="login-title mt-0">@lang('Verify Mobile Number')</h2>
                                    <p class="t-short-para mx-auto mb-0 text-center">
                                        @lang('A 6 digit verification code sent to your mobile number') : +{{ showMobileNumber(auth()->user()->mobileNumber) }}
                                    </p>
                                </div>
                                @if (@gs('sms_config')->name == 'firebase')
                                    <div id="firebase-recaptcha-container"></div>
                                    <form id="firebase-verify-form" action="{{ route('user.verify.mobile.firebase') }}" method="POST" class="submit-form">
                                        @csrf
                                        <input type="hidden" name="id_token" id="firebase-id-token">
                                        @include($activeTemplate . 'partials.verification_code')
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                        </div>
                                        <div class="input--group email-verify mt-3">
                                            @lang('If you don\'t get any code'), <a href="javascript:void(0)" id="firebase-resend-link"> @lang('Try again')</a>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('user.verify.mobile') }}" method="POST" class="submit-form">
                                        @csrf
                                        @include($activeTemplate . 'partials.verification_code')
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                        </div>
                                        <div class="input--group email-verify mt-3">
                                            @lang('If you don\'t get any code'), <span class="countdown-wrapper">@lang('try again after') <span id="countdown" class="fw-bold">--</span> @lang('seconds')</span> <a href="{{ route('user.send.verify.code', 'sms') }}" class="try-again-link d-none"> @lang('Try again')</a>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (@gs('sms_config')->name == 'firebase')
    @push('script')
        {{-- The site already vendors Firebase v7.23.0 locally for push notifications
             (assets/global/js/firebase/firebase-app.js), loaded earlier in the layout
             whenever push notifications are enabled. Loading a different SDK version here
             would stomp on the shared global `firebase` object, so only pull the core app
             script when it isn't already present, and pin the auth script to the exact
             same version the vendored core uses. --}}
        @unless (gs('pn'))
            <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
        @endunless
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-auth.js"></script>
        <script>
            (function($) {
                "use strict";

                var firebaseConfig = {
                    apiKey: @json(gs('sms_config')->firebase->api_key ?? ''),
                    authDomain: @json(gs('sms_config')->firebase->auth_domain ?? ''),
                    projectId: @json(gs('sms_config')->firebase->project_id ?? ''),
                    appId: @json(gs('sms_config')->firebase->app_id ?? ''),
                    messagingSenderId: @json(gs('sms_config')->firebase->messaging_sender_id ?? ''),
                };
                var mobileNumber = @json(auth()->user()->mobileNumber);

                var phoneAuthApp = firebase.initializeApp(firebaseConfig, 'phoneVerification');
                var phoneAuth = phoneAuthApp.auth();

                var recaptchaVerifier = null;
                var confirmationResult = null;

                function initRecaptcha() {
                    recaptchaVerifier = new firebase.auth.RecaptchaVerifier('firebase-recaptcha-container', {
                        size: 'invisible'
                    }, phoneAuthApp);
                    return recaptchaVerifier;
                }

                function sendCode() {
                    phoneAuth.signInWithPhoneNumber('+' + mobileNumber, initRecaptcha())
                        .then(function(result) {
                            confirmationResult = result;
                        })
                        .catch(function(error) {
                            notify('error', error.message);
                        });
                }

                sendCode();

                $('#firebase-resend-link').on('click', function() {
                    if (recaptchaVerifier) {
                        recaptchaVerifier.clear();
                    }
                    sendCode();
                    notify('success', "@lang('Verification code sent successfully')");
                });

                $('#firebase-verify-form').on('submit', function(e) {
                    if ($('#firebase-id-token').val()) {
                        return true;
                    }
                    e.preventDefault();

                    var code = $('#verification-code').val();
                    if (!confirmationResult || code.length != 6) {
                        return false;
                    }

                    confirmationResult.confirm(code).then(function(result) {
                        return result.user.getIdToken();
                    }).then(function(idToken) {
                        $('#firebase-id-token').val(idToken);
                        $('#firebase-verify-form')[0].submit();
                    }).catch(function(error) {
                        notify('error', error.message);
                        $('#verification-code').val('');
                        $('.boxes span').html('');
                    });

                    return false;
                });

            })(jQuery);
        </script>
    @endpush
@else
    @push('script')
        <script>
            var distance =Number("{{ isset($user->ver_code_send_at) ? $user->ver_code_send_at->addMinutes(2)->timestamp - time() : '' }}");
            var x = setInterval(function() {
                distance--;
                document.getElementById("countdown").innerHTML = distance;
                if (distance <= 0) {
                    clearInterval(x);
                    document.querySelector('.countdown-wrapper').classList.add('d-none');
                    document.querySelector('.try-again-link').classList.remove('d-none');
                }
            }, 1000);
        </script>
    @endpush
@endif
