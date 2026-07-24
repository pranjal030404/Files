@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="login__wrapper">
                        <form class="info-form" action="{{ route('user.data.submit', 'educationInfo') }}" autocomplete="off" method="POST">
                            @csrf
                            <div class="section__head d-flex justify-content-between align-items-center flex-wrap pb-4">
                                <h2 class="login-title mt-0">{{ __($pageTitle) }}</h2>
                                <small>@lang('You can also add or update information from your dashboard.')</small>
                                <button class="btn btn--base btn-sm addNewForm mt-0" type="button">
                                    <i class="las la-plus">@lang('Add New')</i>
                                </button>
                            </div>
                            @forelse (old('institute',[]) as $key => $data)
                                <div class="form--area mb-3 border px-4 py-4">
                                    @if (!$loop->first)
                                        <button class="bg-danger remove-btn text-white" type="button"><i class="las la-times"></i></button>
                                    @endif
                                    <div class="row main-form-body">
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="institute[{{ $key }}]" type="text" value="{{ old('institute')[$key] }}" placeholder="" required="">
                                                <label class="form--label">@lang('Institute')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="degree[{{ $key }}]" type="text" value="{{ old('degree')[$key] }}" placeholder="" required="">
                                                <label class="form--label">@lang('Degree')</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="field_of_study[{{ $key }}]" type="text" value="{{ old('field_of_study')[$key] }}" placeholder="" required="">
                                                <label class="form--label">@lang('Field Of Study')</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="reg_no[{{ $key }}]" type="number" value="{{ old('reg_no')[$key] }}" placeholder="">
                                                <label class="form--label">@lang('Registration No.')</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="roll_no[{{ $key }}]" type="number" value="{{ old('roll_no')[$key] }}" placeholder="">
                                                <label class="form--label">@lang('Roll No.')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="start[{{ $key }}]" data-date-format="yyyy" data-language="en" data-min-view="years" data-position="top left" data-view="years" type="number" value="{{ old('start')[$key] }}" placeholder="" required="">
                                                <label class="form--label">@lang('Starting Year')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="end[{{ $key }}]" data-date-format="yyyy" data-language="en" data-min-view="years" data-position="top left" data-view="years" type="number" value="{{ old('end')[$key] }}" placeholder="">
                                                <label class="form--label">@lang('Ending Year')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="result[{{ $key }}]" type="number" value="{{ old('result')[$key] }}" min="0" placeholder="" step="any">
                                                <label class="form--label">@lang('Result')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="out_of[{{ $key }}]" type="number" value="{{ old('out_of')[$key] }}" min="0" placeholder="" step="any">
                                                <label class="form--label">@lang('Out Of')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="form--area mb-3 border px-4 py-4">
                                    <div class="row main-form-body">
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="institute[0]" type="text" placeholder="" required="">
                                                <label class="form--label">@lang('Institute')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="degree[0]" type="text" placeholder="" required="">
                                                <label class="form--label">@lang('Degree')</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="field_of_study[0]" type="text" placeholder="" required="">
                                                <label class="form--label">@lang('Field Of Study')</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="reg_no[0]" type="number" placeholder="">
                                                <label class="form--label">@lang('Registration No.')</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="roll_no[0]" type="number" placeholder="">
                                                <label class="form--label">@lang('Roll No.')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="start[0]" data-date-format="yyyy" data-language="en" data-min-view="years" data-position="top left" data-view="years" type="number" placeholder="" required="">
                                                <label class="form--label">@lang('Starting Year')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="end[0]" data-date-format="yyyy" data-language="en" data-min-view="years" data-position="top left" data-view="years" type="number" placeholder="">
                                                <label class="form--label">@lang('Ending Year')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="result[0]" type="number" min="0" placeholder="" step="any">
                                                <label class="form--label">@lang('Result')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="out_of[0]" type="number" min="0" placeholder="" step="any">
                                                <label class="form--label">@lang('Out Of')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            <div class="append-form"></div>
                            <div class="d-flex justify-content-end flex-wrap gap-2">
                                <button class="btn btn-sm btn--dark back-btn" type="button"><i class="las la-arrow-left"></i>@lang('Back')</button>
                                <button class="btn btn-sm btn--warning skip-btn" type="button"><i class="las la-forward"></i> @lang('Skip')</button>
                                <button class="btn btn-sm btn-success" name="button_value" type="submit" value="submit">@lang('Next') <i class="las la-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
@endpush

@push('style')
    <style>
        .form--area {
            position: relative;
        }

        .remove-btn {
            position: absolute;
            right: 0;
            top: 0px;
            width: 25px;
            height: 25px;
            border: unset;
            border-radius: 0 0 0 12px;
            padding: 0;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";

        if (!$('.datepicker-here').val()) {
            $('.datepicker-here').datepicker({
                autoClose: true,
            });
        }

        $('.addNewForm').on('click', function() {
            let parentDiv = $('.append-form');
            educationForm();

            $(document).find('.datepicker-here').datepicker({
                autoClose: true,
            });
        });

        $(document).on('click', '.remove-btn', function() {
            $(this).parents('.form--area').remove();
        });

        function educationForm() {
            let parentDiv = $('.append-form');
            let totalApendedItem = parentDiv.find('.form--area').length + 1;
            let html = '';
            html += `
            <div class="form--area border mb-3 px-4 py-4">
                <button type="button" class="text-white bg-danger remove-btn"><i class="las la-times"></i></button>
                <div class="row main-form-body">
                    <div class="col-sm-6">
                        <div class="input--group">
                            <input placeholder=" " type="text" name="institute[${totalApendedItem}]" class="form-control form--control" required>
                            <label class="form--label">@lang('Institute')</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input--group">
                            <input placeholder=" " type="text" name="degree[${totalApendedItem}]" class="form-control form--control" required>
                            <label class="form--label">@lang('Degree')</label>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="text" name="field_of_study[${totalApendedItem}]" class="form-control form--control" required>
                            <label class="form--label">@lang('Field Of Study')</label>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="number" name="reg_no[${totalApendedItem}]" class="form-control form--control">
                            <label class="form--label">@lang('Registration No.')</label>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="number" name="roll_no[${totalApendedItem}]" class="form-control form--control">
                            <label class="form--label">@lang('Roll No.')</label>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="number" class="datepicker-here form-control form--control"
                                name="start[${totalApendedItem}]" data-language='en' data-min-view="years" data-view="years"
                                data-date-format="yyyy" data-position='top left' required>
                            <label class="form--label">@lang('Starting Year')</label>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="number" class="datepicker-here form-control form--control" name="end[${totalApendedItem}]"
                            data-language='en' data-min-view="years" data-view="years"
                            data-date-format="yyyy" data-position='top left'>
                            <label class="form--label">@lang('Ending Year')</label>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="number" step="any" min="0" name="result[${totalApendedItem}]" class="form-control form--control">
                            <label class="form--label">@lang('Result')</label>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="input--group">
                            <input placeholder=" " type="number" step="any" min="0" name="out_of[${totalApendedItem}]" class="form-control form--control">
                            <label class="form--label">@lang('Out Of')</label>
                        </div>
                    </div>
                </div>
            </div>
            `;

            parentDiv.append(html);
        }

        $('.skip-btn').on('click', function() {
            $('.info-form').submit();
        });

        $('.back-btn').on('click', function() {
            $('.append-form').append(`<input type="hidden" name="back_to" value="familyInfo">`);
            $('.info-form').submit();
        })
    </script>
@endpush
