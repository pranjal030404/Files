@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="login__wrapper">
                        <form action="{{ route('user.data.submit', 'physicalAttributeInfo') }}" autocomplete="off"
                            class="info-form" method="POST">
                            @csrf
                            <div class="section__head text-center">
                                <h2 class="mt-0 login-title">{{ __($pageTitle) }}</h2>
                            </div>
                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="complexion" required type="text"
                                            value="{{ old('complexion') }}">
                                        <label class="form--label">@lang('Complexion')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" min="0" name="height" required
                                            step="any" type="number" value="{{ old('height') }}">
                                        <label class="form--label">@lang('Height')</label>
                                        <span class="input-group-text">@lang('Feet')</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" min="0" name="weight" required
                                            step="any" type="number" value="{{ old('weight') }}">
                                        <label class="form--label">@lang('Weight')</label>
                                        <span class="input-group-text">@lang('KG')</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="blood_group" required>
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($bloodGroups as $blood)
                                                <option value="{{ $blood->name }}">{{ __($blood->name) }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Blood Group')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="eye_color" required type="text"
                                            value="{{ old('eye_color') }}">
                                        <label class="form--label">@lang('Eye Color')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="hair_color" required type="text"
                                            value="{{ old('hair_color') }}">
                                        <label class="form--label">@lang('Hair Color')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="disability" type="text"
                                            value="{{ old('disability') }}">
                                        <label class="form--label">@lang('Disability')</label>
                                    </div>
                                </div>
                                <div class="append-form d-none"></div>
                                <div class="d-flex justify-content-end flex-wrap gap-2">
                                    <button class="btn btn-sm btn--dark back-btn" type="button"><i
                                            class="las la-arrow-left"></i>@lang('Back')</button>
                                    <button class="btn btn-sm btn--warning skip-btn" type="button"><i
                                            class="las la-forward"></i> @lang('Skip')</button>
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

@push('script')
    <script>
        "use strict";

        $('.skip-btn').on('click', function() {
            $('.info-form').submit();
        })

        $('.back-btn').on('click', function() {
            $('.append-form').append(`<input type="hidden" name="back_to" value="careerInfo">`);
            $('.info-form').submit();
        })
    </script>
@endpush
