@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login__wrapper">
                        <div class="section__head text-center">
                            <h2 class="mt-0 login-title">{{ __(@$loginContent->data_values->heading) }}</h2>
                            <p class="t-short-para mx-auto text-center mb-0">
                                {{ __(@$loginContent->data_values->subheading) }}
                            </p>
                        </div>
                        <form action="{{ route('user.login') }}" autocomplete="off" class="verify-gcaptcha" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mt-0">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="user-name" name="username" required type="text" value="{{ old('username') }}">
                                        <label class="form--label" for="user-name">@lang('Username or Email')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="password" name="password" required type="password">
                                        <label class="form--label" for="password">@lang('Password')</label>
                                        <div class="fa fa-fw fa-eye field-icon toggle-password" id="#password"></div>
                                    </div>
                                </div>

                                <x-captcha :path="$activeTemplate . 'partials.'" />

                                <div class="col-sm-12 mt-4">

                                    <div class="input--group text-start d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="form--check">
                                            <input {{ old('remember') ? 'checked' : '' }} autocomplete="off" class="form-check-input" id="remember" name="remember" type="checkbox">
                                            <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                                        </div>
                                        <a class="text--base" href="{{ route('user.password.request') }}">
                                            @lang('Forgot your password?')
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button class="btn  btn--base mt-3 w-100" type="submit">
                                        @lang('Login')
                                    </button>
                                </div>

                                <div class="col-sm-12">
                                    <div class="login-account text-center">
                                        <p class="mb-0 mt-4">@lang('Haven\'t any acoount? ')
                                            <a href="{{ route('user.register') }}">@lang('Sign Up')</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @include($activeTemplate . 'partials.social_login')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
