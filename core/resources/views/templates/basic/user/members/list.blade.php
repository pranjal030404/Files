@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- Search Result  -->
    <div class="section search">
        <div class="container">
            <div class="row g-xl-4">
                <div class="col-xl-3 d-xl-block">
                    <div class="search__left">
                        <div class="search__left-btn d-xl-none d-block">
                            <i class="las la-times"></i>
                        </div>
                        <form class="form-search" action="{{ route('member.list') }}" autocomplete="off">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="search__left-title">
                                        <h5 class="text mt-0 mb-0">@lang('Member Filter') </h5>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="member-id" name="member_id"
                                            type="text">
                                        <label class="form--label" for="member-id">@lang('Member ID')</label>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="range-slider">
                                        <p>
                                            <label class="range-slider__label" for="height">@lang('Height'):</label>
                                            <input class="range-slider__number" id="height" name="height" type="text"
                                                readonly>
                                        </p>
                                        <div id="slider-range"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="looking_for">
                                            <option value="">@lang('All')</option>
                                            <option value="1" @selected(request()->looking_for == 1)>@lang('Bridegroom')</option>
                                            <option value="2" @selected(request()->looking_for == 2)>@lang('Bride')</option>
                                        </select>
                                        <label class="form--label">@lang('Looking For')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="marital_status">
                                            <option value="">@lang('All')</option>
                                            @foreach ($maritalStatuses as $maritalStatus)
                                                <option value="{{ $maritalStatus->title }}" @selected(request()->marital_status == $maritalStatus->title)>
                                                    {{ __($maritalStatus->title) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Marital Status')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="religion">
                                            <option value="">@lang('All')</option>
                                            @foreach ($religions as $religion)
                                                <option value="{{ $religion->name }}">{{ __($religion->name) }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Religion')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="country">
                                            <option value="">@lang('All')</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}" @selected($country == request()->country)>
                                                    {{ __($country) }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Country')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="profession" name="profession"
                                            type="text" value="{{ request()->profession }}">
                                        <label class="form--label" for="profession">@lang('Profession')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="city" name="city"
                                            type="text" value="{{ request()->city }}">
                                        <label class="form--label" for="city">@lang('City')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="smoking_status">
                                            <option value="">@lang('All')</option>
                                            <option value="1" @selected(request()->smoking_status == Status::YES)>@lang('Smoker')</option>
                                            <option value="0" @selected(request()->smoking_status == Status::NO && request()->smoking_status != null)>@lang('Non-smoker')</option>
                                        </select>
                                        <label class="form--label">@lang('Smoking Habits')</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="drinking_status">
                                            <option value="">@lang('All')</option>
                                            <option value="1" @selected(request()->drinking_status == Status::YES)>@lang('Drunker')</option>
                                            <option value="0" @selected(request()->drinking_status == Status::NO && request()->drinking_status != null)>@lang('Non-drunker')</option>
                                        </select>
                                        <label class="form--label">@lang('Drinking Status')</label>
                                    </div>
                                </div>
                            </div>
                            <input name="page" type="hidden">
                        </form>
                    </div>
                </div>
                <div class="col-xl-9 col-md-12">
                    <div class="position-relative">
                        <div class="search-overlay d-none">
                            <div class="search-overlay__inner">
                                <span class="search-overlay__spinner"></span>
                            </div>
                        </div>
                        <div class="search__left-bar mb-xl-0 d-flex justify-content-between mb-3 flex-wrap">
                            <div class="filter-icon d-xl-none d-block">
                                <i class="las la-sliders-h"></i>
                            </div>
                        </div>
                        <div class="row gy-4 member-wrapper">
                            @include($activeTemplate . 'partials.members')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Result End -->

    <x-report-modal />
    <x-interest-express-modal />
    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            let min = "{{ $height['min'] }}";
            let max = "{{ $height['max'] }}";

            let minHeight = parseFloat(min);
            let maxHeight = Math.ceil(parseFloat(max));
            //height range
            $("#slider-range").slider({
                range: true,
                min: minHeight,
                max: maxHeight,

                values: [minHeight, maxHeight],
                slide: function(event, ui) {
                    $("#height").val("" + ui.values[0] + " - " + ui.values[1] + " Ft");
                },
                stop: function(event, ui) {
                    $('.form-search').submit();
                }
            });
            $("#height").val("" + $("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1) + " Ft");


            // search by ajax
            let form = $('.form-search');
            form.find('.form--control').on('focusout, change', function() {
                form.find('[name=page]').val(0);
                form.submit();
            });

            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                if ($(this).parents('.page-item').hasClass('active')) {
                    return false;
                }

                let page = $(this).attr('href').match(/page=([0-9]+)/)[1];
                form.find('[name=page]').val(page);
                form.submit();
            });

            form.on('submit', function(e) {
                e.preventDefault();
                let data = form.serialize();

                let url = form.attr('action');
                let wrapper = $('.member-wrapper');

                $.ajax({
                    type: "get",
                    url: url,
                    data: data,
                    dataType: "json",
                    beforeSend: function() {
                        $(document).find('.search-overlay').removeClass('d-none');
                    },
                    success: function(response) {
                        if (response.html) {
                            wrapper.html(response.html);
                        }
                    },
                    complete: function() {
                        $(document).find('.search-overlay').addClass('d-none');
                    },
                });

            })

        })(jQuery);
    </script>

    <script>
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let config = {
            routes: {
                addShortList: "{{ route('user.add.short.list') }}",
                removeShortList: "{{ route('user.remove.short.list') }}",
            },
            loadingText: {
                addShortList: "{{ trans('Shortlisting') }}",
                removeShortList: "{{ trans('Removing') }}",
                interestExpress: "{{ trans('Processing') }}",
            },
            buttonText: {
                addShortList: "{{ trans('Shortlist') }}",
                removeShortList: "{{ trans('Shortlisted') }}",
                interestExpressed: "{{ trans('Interested') }}",
                expressInterest: "{{ trans('Interest') }}",
            }
        }

        $('.express-interest-form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let url = $(this).attr('action');
            let modal = $('#interestExpressModal');
            let id = modal.find('[name=interesting_id]').val();
            let li = $(`.interestExpressBtn[data-interesting_id="${id}"]`).parents('li');
            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(li).find('a').html(
                        `<i class="fas fa-heart"></i>${config.loadingText.interestExpress}..`);
                },
                success: function(response) {
                    modal.modal('hide');
                    if (response.success) {
                        notify('success', response.success);
                        li.find('a').remove();
                        li.html(`<a href="javascript:void(0)" class="base-color">
                            <i class="fas fa-heart"></i>${config.buttonText.interestExpressed}
                        </a>`);
                    } else {
                        notify('error', response.error);
                        li.html(`<a href="javascript:void(0)" class="interestExpressBtn" data-interesting_id="${id}">
                                <i class="fas fa-heart"></i>${config.buttonText.expressInterest}
                        </a>`);
                    }
                }
            });
        })
    </script>
    <script src="{{ asset($activeTemplateTrue . 'js/member.js') }}"></script>
@endpush
