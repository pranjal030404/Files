@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="login__wrapper">
                        <form class="info-form" action="{{ route('user.data.submit', 'careerInfo') }}" autocomplete="off" method="POST">
                            @csrf
                            <div class="section__head d-flex justify-content-between align-items-center flex-wrap pb-4">
                                <h2 class="login-title mt-0">{{ __($pageTitle) }}</h2>
                                <small>@lang('You can also add or update information from your dashboard.')</small>
                                <button class="btn btn--base btn-sm addNewForm mt-0" type="button">
                                    <i class="las la-plus">@lang('Add New')</i>
                                </button>
                            </div>
                            @forelse (old('company', []) as $key => $item)
                                <div class="form--area mb-3 border px-4 py-4">
                                    @if (!$loop->first)
                                        <button class="bg-danger remove-btn text-white" type="button"><i class="las la-times"></i></button>
                                    @endif
                                    <div class="row main-form-body g-4">
                                        <div class="col-sm-12">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="company[{{ $key }}]" type="text" value="{{ old('company')[$key] }}" required>
                                                <label class="form--label">@lang('Company')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="designation[{{ $key }}]" type="text" value="{{ old('designation')[$key] }}" required>
                                                <label class="form--label">@lang('Designation')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="start[{{ $key }}]" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="number" value="{{ old('start')[$key] }}" required>
                                                <label class="form--label">@lang('Starting Year')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="end[{{ $key }}]" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="number" value="{{ old('end')[$key] }}" value="{{ old('end')[$key] }}">
                                                <label class="form--label">@lang('Ending Year')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="form--area mb-3 border px-4 py-4">
                                    <div class="row main-form-body g-4">
                                        <div class="col-sm-12">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="company[0]" type="text" placeholder=" " required>
                                                <label class="form--label">@lang('Company')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input--group">
                                                <input class="form-control form--control" name="designation[0]" type="text" required>
                                                <label class="form--label">@lang('Designation')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="start[0]" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="number" required>
                                                <label class="form--label">@lang('Starting Year')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input--group">
                                                <input class="datepicker-here form-control form--control" name="end[0]" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="number">
                                                <label class="form--label">@lang('Ending Year')</label>
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
            top: 0;
            width: 25px;
            height: 25px;
            border: unset;
            border-radius: 0 0 0 8px;
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
                <div class="row main-form-body g-4">
                    <div class="col-sm-12">
                        <div class="input--group">
                            <input placeholder=" " type="text" name="company[]" class="form-control form--control" required>
                            <label class="form--label">@lang('Company')</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input--group">
                            <input placeholder=" " type="text" name="designation[]" class="form-control form--control" required>
                            <label class="form--label">@lang('Designation')</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input--group">
                            <input placeholder=" " type="number" class="datepicker-here form-control form--control"
                            name="start[]" data-language='en' data-min-view="years"
                            data-view="years" data-date-format="yyyy" data-position='top left' required>
                            <label class="form--label">@lang('Starting Year')</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input--group">
                            <input placeholder=" " type="number" class="datepicker-here form-control form--control"
                            name="end[]" data-language='en' data-min-view="years" data-view="years"
                            data-date-format="yyyy" data-position='top left'>
                            <label class="form--label">@lang('Ending Year')</label>
                        </div>
                    </div>
                </div>
            </div>
            `;

            parentDiv.append(html);
        }

        $('.skip-btn').on('click', function() {
            $('.info-form').submit();
        })

        $('.back-btn').on('click', function() {
            $('.append-form').append(`<input type="hidden" name="back_to" value="educationInfo">`);
            $('.info-form').submit();
        })
    </script>
@endpush
