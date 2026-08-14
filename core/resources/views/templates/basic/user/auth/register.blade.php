@extends($activeTemplate . 'layouts.frontend')
@php
    $registerContent = getContent('register.content', true);
    $policyPages = getContent('policy_pages.element', false, null, true);
@endphp
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login__wrapper @if (!gs('registration')) form-disabled @endif">
                        @if (!gs('registration'))
                            @php
                                $baseColor = gs('base_color');
                            @endphp
                            <span class="form-disabled-text">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <defs>
                                            <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                <path d="M0 512h512V0H0Z" fill="#{{ $baseColor }}" opacity="1" data-original="#000000" class=""></path>
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                            <path d="M0 0h-299.927c-17.003 0-30.786 13.784-30.786 30.787v239.676c0 17.003 13.783 30.787 30.786 30.787H0c17.003 0 30.787-13.784 30.787-30.787V30.787C30.787 13.784 17.003 0 0 0Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(405.963 15)" fill="none" stroke="#{{ $baseColor }}" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path>
                                            <path d="M0 0c0-16.638-13.487-30.125-30.125-30.125C-46.763-30.125-60.25-16.638-60.25 0c0 16.638 13.487 30.125 30.125 30.125C-13.487 30.125 0 16.638 0 0Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(286.125 193.15)" fill="none" stroke="#{{ $baseColor }}" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path>
                                            <path d="M0 0v-60.25" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(256 163.025)" fill="none" stroke="#{{ $baseColor }}" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path>
                                            <path d="M0 0h-60v67.416c0 29.456-23.878 53.334-53.334 53.334h-14.082c-29.456 0-53.334-23.878-53.334-53.334V0h-60v60.375c0 66.481 53.894 120.375 120.375 120.375v0C-53.894 180.75 0 126.856 0 60.375Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(376.375 316.25)" fill="none" stroke="#{{ $baseColor }}" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        @endif
                        <form class="login__form verify-gcaptcha" action="{{ route('user.register') }}" autocomplete="off" method="POST">
                            @csrf
                            <div class="section__head text-center">
                                <h2 class="login-title mt-0">{{ __($registerContent->data_values->heading) }}</h2>
                                <p class="t-short-para mx-auto mb-0 text-center">
                                    {{ __($registerContent->data_values->subheading) }}
                                </p>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="firstname" name="firstname" type="text" value="{{ old('firstname') }}" autocomplete="off" placeholder="none" required>
                                        <label class="form--label" for="firstname">@lang('First Name')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="lastname" name="lastname" type="text" value="{{ old('lastname') }}" autocomplete="off" placeholder="none" required>
                                        <label class="form--label" for="lastname">@lang('Last Name')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control checkUser" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="none" required>
                                        <label class="form--label" for="email">@lang('E-Mail Address')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <span class="input-group-text">+91</span>
                                        <input name="mobile_code" type="hidden" value="91">
                                        <input name="country_code" type="hidden" value="IN">
                                        <label class="form--label" for="mobile">@lang('Mobile')</label>
                                        <input class="form-control form--control" id="mobile" name="mobile"
                                            type="text" value="{{ old('mobile') }}" placeholder="none" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>
                                <div class="col-sm-6 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control @if (gs('secure_password')) secure-password @endif" id="password" name="password" type="password" placeholder="none" required>
                                        <label class="form--label" for="password">@lang('Password')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="password_confirmation" name="password_confirmation" type="password" placeholder="none" required>
                                        <label class="form--label" for="password_confirmation">@lang('Confirm Password')</label>
                                    </div>
                                </div>

                                <x-captcha :path="$activeTemplate . 'partials.'" />

                                @if (gs('agree'))
                                    <div class="col-sm-12 mt-4">
                                        <div class="input--group d-flex align-items-center justify-content-start flex-wrap text-start">
                                            <div class="form--check me-2">
                                                <input class="form-check-input" id="agree" name="agree" type="checkbox" @checked(old('agree')) required>
                                                <label class="form-check-label" for="agree">
                                                    @lang('I agree with ')
                                                </label>
                                                @foreach ($policyPages as $policy)
                                                    <a href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}" target="_blank">
                                                        {{ __($policy->data_values->title) }}
                                                    </a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <button class="btn btn--md btn--base w-100" data-bs-toggle="list" type="submit"> @lang('Register') </button>
                                </div>

                                <div class="col-sm-12">
                                    <div class="login-account text-center">
                                        <p class="mb-0 mt-3">@lang('Have an account? ') <a href="{{ route('user.login') }}">@lang('Login')</a></p>
                                    </div>
                                </div>

                            </div>
                        </form>
                        @include($activeTemplate . 'partials.social_login', ['register' => true])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="existModalCenter" role="dialog" aria-hidden="true" aria-labelledby="existModalCenterTitle" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6>@lang('You already have an account, please login!')</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark btn-sm" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                    <a class="btn btn--base btn-sm" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
    @push('script')
        <script>
            "use strict";
            (function($) {

                $('.checkUser').on('focusout', function(e) {
                    var url = '{{ route('user.checkUser') }}';
                    var value = $(this).val();
                    var token = '{{ csrf_token() }}';

                    var data = {
                        email: value,
                        _token: token
                    }

                    $.post(url, data, function(response) {
                        if (response.data != false) {
                            $('#existModalCenter').modal('show');
                        }
                    });
                });
            })(jQuery);
        </script>
    @endpush
@endif

@push('script')
    <script>
        "use strict";
        (function($) {

            $('#mobile').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';
                var data = {
                    mobile: $(this).val(),
                    mobile_code: '91',
                    _token: token
                }
                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('.mobileExist').text(`${response.field} already exist`);
                    } else {
                        $('.mobileExist').text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush

@if (!gs('registration'))
    @push('style')
        <style>
            .form-disabled {
                overflow: hidden;
                position: relative;
            }

            .form-disabled::after {
                content: "";
                position: absolute;
                height: 100%;
                width: 100%;
                background-color: rgba(255, 255, 255, 0.2);
                top: 0;
                left: 0;
                backdrop-filter: blur(2px);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                z-index: 99;
            }

            .form-disabled-text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 991;
                font-size: 24px;
                height: auto;
                width: 100%;
                text-align: center;
                font-weight: 800;
                line-height: 1.2;
            }

            .form-disabled-text svg path {
                fill: #fff;
            }
        </style>
    @endpush
@endif
