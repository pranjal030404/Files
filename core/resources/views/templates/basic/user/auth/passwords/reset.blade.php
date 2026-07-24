@php
    $content = getContent('reset_password.content', true);
@endphp
@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login__wrapper">
                        <div class="section__head text-center">
                            <h2 class="login-title mt-0">{{ __(@$content->data_values->heading) }}</h2>
                            <p class="t-short-para mx-auto mb-0 text-center">
                                {{ __(@$content->data_values->subheading) }}
                            </p>
                        </div>
                        <form action="{{ route('user.password.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mt-0">
                                    <div class="input--group">
                                        <input name="email" type="hidden" value="{{ $email }}">
                                        <input name="token" type="hidden" value="{{ $token }}">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="password" name="password" type="password" required>
                                            <label class="form--label" for="password">@lang('Password')</label>
                                            @if (gs('secure_password'))
                                                <div class="input-popup">
                                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                                    <p class="error number">@lang('1 number minimum')</p>
                                                    <p class="error special">@lang('1 special character minimum')</p>
                                                    <p class="error minimum">@lang('6 character password')</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="password_confirmation" name="password_confirmation" type="password" required>
                                        <label class="form--label" for="password_confirmation">@lang('Confirm Password')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button class="btn btn--base w-100 mt-3" type="submit">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
