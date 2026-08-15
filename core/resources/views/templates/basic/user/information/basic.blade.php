@php
    $user = auth()->user();
@endphp
@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section basic-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login__wrapper basic-information">
                        <form class="info-form" action="{{ route('user.data.submit', 'basicInfo') }}" autocomplete="off"
                            method="POST">
                            @csrf
                            <div class="section__head text-center">
                                <h2 class="login-title mt-0">@lang('Basic Information')</h2>
                                <p>@lang('Please complete your profile with accurate and authenticated information. Providing complete and truthful details is essential to access your dashboard.')</p>
                            </div>
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form--control form-control" id="looking_for"
                                            name="looking_for" required>
                                            <option value="">@lang('Select One')</option>
                                            <option value="1" @selected(old('looking_for') == 1)>@lang('Bridegroom')</option>
                                            <option value="2" @selected(old('looking_for') == 2)>@lang('Bride')</option>
                                        </select>
                                        <label class="form--label" for="looking_for">@lang('Looking For')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control checkUser" id="username" name="username"
                                            type="text" value="{{ old('username') }}" autocomplete="off"
                                            placeholder="none" required>
                                        <label class="form--label" for="username">@lang('Username')</label>
                                        <small class="text-danger usernameExist"></small>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="select2 form-control form--control" id="country" name="country">
                                            @foreach ($countries as $key => $country)
                                                <option data-code="{{ $key }}"
                                                    data-mobile_code="{{ $country->dial_code }}"
                                                    value="{{ $country->country }}" @selected(old('country') == $key)>
                                                    {{ __($country->country) }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label" for="country">@lang('Country')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <span class="input-group-text mobile-code"></span>
                                        <input name="mobile_code" type="hidden">
                                        <input name="country_code" type="hidden">
                                        <label class="form--label" for="mobile">@lang('Mobile')</label>
                                        <input class="form-control form--control checkUser" id="mobile" name="mobile"
                                            type="text" value="{{ old('mobile') }}" placeholder="none" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="datepicker-here form-control form--control" name="birth_date"
                                            data-date-format="yyyy-mm-dd" data-language="en" data-position='bottom right'
                                            data-range="false" type="text" value="{{ old('birth_date') }}"
                                            autocomplete="off" required>
                                        <label class="form--label">@lang('Date Of Birth')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="religion" required>
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($religions as $religion)
                                                <option value="{{ $religion->name }}"
                                                    @if (old('religion') == $religion->name) selected @endif>
                                                    {{ __($religion->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Religion')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="caste">
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($castes as $caste)
                                                <option value="{{ $caste->name }}"
                                                    @if (old('caste') == $caste->name) selected @endif>
                                                    {{ __($caste->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Caste')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="gender" required>
                                            <option value="">@lang('Select One')</option>
                                            <option value="m" @if (old('gender') == 'm') selected @endif>
                                                @lang('Male')</option>
                                            <option value="f" @if (old('gender') == 'f') selected @endif>
                                                @lang('Female')</option>
                                        </select>
                                        <label class="form--label">@lang('Gender')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="marital_status"
                                            required>
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($maritalStatuses as $maritalStatus)
                                                <option value="{{ $maritalStatus->title }}"
                                                    @if (old('marital_status') == $maritalStatus->title) selected @endif>
                                                    {{ __($maritalStatus->title) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Marital Status')</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-control form--control select2-auto-tokenize" name="languages[]"
                                            multiple="multiple" placeholder="none" required>
                                            @foreach (old('languages', []) as $oldLanguage)
                                                <option value="{{ $oldLanguage }}" selected>{{ $oldLanguage }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Languages')</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="profession" type="text"
                                            value="{{ old('profession') }}" required>
                                        <label class="form--label">@lang('Profession')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="financial_condition"
                                            type="text" value="{{ old('financial_condition') }}" required>
                                        <label class="form--label">@lang('Financial Condition')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="smoking_status"
                                            required>
                                            <option value="">@lang('Select One')</option>
                                            <option value="1" @selected(old('smoking_status') == 1)>@lang('Smoker')</option>
                                            <option value="0" @selected(old('smoking_status') == 0)>@lang('Non-smoker')</option>
                                        </select>
                                        <label class="form--label">@lang('Smoking Habits')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="drinking_status"
                                            required>
                                            <option value="">@lang('Select One')</option>
                                            <option value="1" @selected(old('drinking_status') == 1)>@lang('Drunker')</option>
                                            <option value="0" @selected(old('drinking_status') == 0)>@lang('Non-drunker')</option>
                                        </select>
                                        <label class="form--label">@lang('Drinking Status')</label>
                                    </div>
                                </div>

                                <small>@lang('Present Address')</small>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="pre_state" type="text"
                                            value="{{ old('pre_state', $user->state) }}">
                                        <label class="form--label">@lang('State')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="pre_zip" type="text"
                                            value="{{ old('pre_zip', $user->zip) }}">
                                        <label class="form--label">@lang('Zip Code')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="pre_city" type="text"
                                            value="{{ old('pre_city', $user->city) }}" required>
                                        <label class="form--label">@lang('City')</label>
                                    </div>
                                </div>

                                <small>
                                    <div class="form--check">
                                        @lang('Permanent Address') :
                                        <input class="form-check-input" id="copyAddress" type="checkbox">
                                        <label class="form-check-label" for="copyAddress">
                                            @lang('Same as present address?')
                                        </label>
                                    </div>
                                </small>

                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="select2 form-control form--control" name="per_country" required>
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->country }}"
                                                    @if (old('per_country') == $country->country) selected @endif>
                                                    {{ __($country->country) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Present Country')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control permanent" name="per_state"
                                            type="text" value="{{ old('per_state') }}" required>
                                        <label class="form--label">@lang('State')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control permanent" name="per_zip" type="text"
                                            value="{{ old('per_zip') }}">
                                        <label class="form--label">@lang('Zip Code')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control permanent" name="per_city"
                                            type="text" value="{{ old('per_city') }}" required>
                                        <label class="form--label">@lang('City')</label>
                                    </div>
                                </div>
                                <div class="append-form d-none"></div>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-success" name="button_value" type="submit"
                                        value="submit">@lang('Next') <i class="las la-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link href="{{ asset('assets/global/css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";

        $.each($('.select2'), function() {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });

        $('#copyAddress').on('change', function() {
            let perCountry = $('[name=per_country]');
            let perState = $('[name=per_state]');
            let perZip = $('[name=per_zip]');
            let perCity = $('[name=per_city]');
            if ($(this).is(':checked')) {
                perCountry.val($('[name=country]').val()).select2();
                perState.val($('[name=pre_state]').val());
                perZip.val($('[name=pre_zip]').val());
                perCity.val($('[name=pre_city]').val());
            } else {
                perCountry.val('');
                perState.val('');
                perZip.val('');
                perCity.val('');
            }
        });

        @if ($mobileCode)
            $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
        @endif

        $('select[name=country]').on('change', function() {
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            var value = $('[name=mobile]').val();
            var name = 'mobile';
            checkUser(value, name);
        });

        $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
        $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
        $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


        $('.checkUser').on('focusout', function(e) {
            var value = $(this).val();
            var name = $(this).attr('name')
            checkUser(value, name);
        });

        function checkUser(value, name) {
            var url = '{{ route('user.checkUser') }}';
            var token = '{{ csrf_token() }}';

            if (name == 'mobile') {
                var mobile = `${value}`;
                var data = {
                    mobile: mobile,
                    mobile_code: $('.mobile-code').text().substr(1),
                    _token: token
                }
            }
            if (name == 'username') {
                var data = {
                    username: value,
                    _token: token
                }
            }
            $.post(url, data, function(response) {
                if (response.data != false) {
                    $(`.${response.type}Exist`).text(`${response.field} already exist`);
                } else {
                    $(`.${response.type}Exist`).text('');
                }
            });
        }

        $('.select2-auto-tokenize').select2({
            dropdownParent: $('.basic-info'),
            tags: true,
            tokenSeparators: [',']
        });
    </script>
@endpush
