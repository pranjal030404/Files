@php
    $user = auth()->user();
    $info = json_decode(json_encode(getIpInfo()), true);
    $mobile_code = @implode(',', $info['code']);
    $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section basic-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login__wrapper basic-information">
                        <form class="info-form" action="{{ route('user.information.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="section__head text-center">
                                <h2 class="login-title mt-0">{{ __($pageTitle) }}</h2>
                            </div>
                            <div class="row gy-4">
                                @if (!$user->mobile)
                                    <div class="col-sm-12">
                                        <div class="input--group">
                                            <select class="form-select form-control form--control" name="country">
                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}" data-code="{{ $key }}" value="{{ $country->country }}">
                                                        {{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                            <label class="form--label">@lang('Country')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input--group">
                                            <div class="input-group">
                                                <span class="input-group-text mobile-code"></span>
                                                <input name="mobile_code" type="hidden">
                                                <input name="country_code" type="hidden">
                                                <input class="form-control form--control" id="mobile" name="mobile" type="number" value="{{ old('mobile') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (!$user->email)
                                    <div class="col-sm-12">
                                        <div class="input--group">
                                            <input class="form-control form--control" name="email" type="text" value="{{ old('email') }}" required>
                                            <label class="form--label">@lang('Email')</label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12">
                                    <button class="btn btn--base w-100" type="submit">@lang('Submit') </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
@endpush
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobile_code)
            $(`option[data-code={{ $mobile_code }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

        })(jQuery);
    </script>
@endpush
