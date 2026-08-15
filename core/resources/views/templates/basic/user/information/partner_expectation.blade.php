@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section partner-expectation">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="login__wrapper">
                        <form class="info-form" action="{{ route('user.data.submit', 'partnerExpectation') }}" autocomplete="off" method="POST">
                            @csrf
                            <div class="section__head text-center">
                                <h2 class="login-title mt-0">{{ __($pageTitle) }}</h2>
                            </div>
                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <textarea class="form-control form--control" name="general_requirement" value="{{ old('general_requirement') }}"></textarea>
                                        <label class="form--label">@lang('General Requirement')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <div class="input--group">
                                            <select name="country"class="select2 form-control form--control">
                                                <option value="">@lang('Select One')</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->country }}">{{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                            <label class="form--label">@lang('Country')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="min_age" type="number" value="{{ old('min_age') }}" min="0" step="any">
                                        <label class="form--label">@lang('Minimum Age')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="max_age" type="number" value="{{ old('max_age') }}" min="0" step="any">
                                        <label class="form--label">@lang('Maximum Age')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="min_height" type="number" value="{{ old('min_height') }}" min="0" step="any">
                                        <label class="form--label">@lang('Minimum Height')</label>
                                        <span class="input-group-text">@lang('Feet')</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="max_height" type="number" value="{{ old('max_height') }}" min="0" step="any">
                                        <label class="form--label">@lang('Maximum Height')</label>
                                        <span class="input-group-text">@lang('Feet')</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="max_weight" type="number" value="{{ old('max_weight') }}" min="0" step="any">
                                        <label class="form--label">@lang('Maximum Weight')</label>
                                        <span class="input-group-text">@lang('KG')</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="marital_status">
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($maritalStatuses as $maritalStatus)
                                                <option value="{{ $maritalStatus->title }}" @selected(old('marital_status' == $maritalStatus->title))>{{ __($maritalStatus->title) }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Marital Status')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="religion">
                                            <option value="">@lang('Religion')</option>
                                            @foreach ($religions as $religion)
                                                <option value="{{ $religion->name }}" @selected(old('religion' == $religion->name))>{{ __($religion->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="caste">
                                            <option value="">@lang('Caste')</option>
                                            @foreach ($castes as $caste)
                                                <option value="{{ $caste->name }}" @selected(old('caste' == $caste->name))>{{ __($caste->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="complexion" type="text" value="{{ old('complexion') }}">
                                        <label class="form--label">@lang('Complexion')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="smoking_status">
                                            <option value="">@lang('Select One')</option>
                                            <option value="1" @selected(old('smoking_status' == 1))>@lang('Smoker')</option>
                                            <option value="2" @selected(old('smoking_status' == 2))>@lang('Non-smoker')</option>
                                        </select>
                                        <label class="form--label">@lang('Smoking Habits')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="drinking_status">
                                            <option value="">@lang('Select One')</option>
                                            <option value="1" @selected(old('drinking_status' == 1))>@lang('Drunker')</option>
                                            <option value="2" @selected(old('drinking_status' == 2))>@lang('Restrianed')</option>
                                        </select>
                                        <label class="form--label">@lang('Drinking Status')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="min_degree" type="text" value="{{ old('min_degree') }}">
                                        <label class="form--label">@lang('Minimum Degree')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="profession" type="text" value="{{ old('profession') }}">
                                        <label class="form--label">@lang('Profession')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <select class="form-control form--control select2-auto-tokenize" name="language[]" multiple="multiple">
                                        </select>
                                        <label class="form--label">@lang('Languages')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="personality" type="text" value="{{ old('personality') }}">
                                        <label class="form--label">@lang('Personality')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="financial_condition" type="text" value="{{ old('financial_condition') }}">
                                        <label class="form--label">@lang('Financial Condition')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="family_position" type="text" value="{{ old('family_position') }}">
                                        <label class="form--label">@lang('Family Position')</label>
                                    </div>
                                </div>
                                <div class="append-form d-none"></div>
                                <div class="d-flex justify-content-end flex-wrap gap-2">
                                    <button class="btn btn-sm btn--dark back-btn" type="button"><i class="las la-arrow-left"></i>@lang('Back')</button>
                                    <button class="btn btn-sm btn--warning skip-btn" type="button"><i class="las la-forward"></i> @lang('Skip')</button>
                                    <button class="btn btn-sm btn-success" name="button_value" type="submit" value="submit">@lang('Next') <i class="las la-arrow-right"></i></button>
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
@endpush

@push('script')
    <script>
        "use strict";

        if (!$('.datepicker-here').val()) {
            $('.datepicker-here').datepicker({
                autoClose: true,
            });
        }

        $('.skip-btn').on('click', function() {
            $('.info-form').submit();
        });

        $.each($('.select2'), function() {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });

        $('.select2-auto-tokenize').select2({
            dropdownParent: $('.partner-expectation'),
            tags: true,
            tokenSeparators: [',']
        });

        $('.back-btn').on('click', function() {
            $('.append-form').append(`<input type="hidden" name="back_to" value="physicalAttributeInfo">`);
            $('.info-form').submit();
        });
    </script>
@endpush
