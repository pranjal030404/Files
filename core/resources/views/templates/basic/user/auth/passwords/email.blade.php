@php
    $forgotPassContent = getContent('reset_password.content', true);
@endphp
@extends('Template::layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login__wrapper">
                        <div class="section__head recovery__head-section text-center">
                            <h2 class="login-title mt-0">{{ __($pageTitle) }}</h2>
                            <p class="t-short-para mx-auto mb-0 text-center">
                                @lang('To recover your account please provide your email or username to find your account.')
                            </p>
                        </div>
                        <form class="recovery-form" action="{{ route('user.password.email') }}" autocomplete="off" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="value" name="value" type="text" value="{{ old('value') }}" autofocus="off" required>
                                        <label class="form--label" for="value">@lang('Email or Username')</label>
                                    </div>
                                </div>

                                <x-captcha :path="$activeTemplate . 'partials.'" />

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
