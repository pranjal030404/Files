@extends('Template::layouts.frontend')
@section('content')
    <!-- Dashboard  -->
    <div class="section bg-light">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xxl-3 col-lg-4 col-md-8">
                    <div class="profile-sidebar">
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <div class="public-profile">
                                    <div class="team-card border-0" style="width: 100%; display: inline-block;">
                                        <div class="team-card__img mx-auto">
                                            <img class="team-card__img-is" src="{{ $member->profilePicture() }}"
                                                 alt="@lang('Profile Image')">
                                        </div>
                                        <div class="team-card__body p-3 text-start">
                                            <div
                                                 class="profile-name-interest d-flex align-items-center justify-content-between flex-wrap">
                                                <div class="profile-name">
                                                    <h5 class="dashboard-profile__name team-card__body-name mb-0 mt-0">
                                                        {{ $member->fullname }}</h5>
                                                    <h6 class="dashboard-profile__id team-card__body-id my-2">
                                                        @lang('ID') :
                                                        {{ $member->profile_id }} </h6>
                                                </div>

                                                <div class="profile-interest text-center">
                                                    @if ($user->interests->where('interesting_id', $member->id)->first())
                                                        <a class="profile-interest-love base-color"
                                                           href="javascript:void(0)">
                                                            <i class="fas fa-heart"></i> <span
                                                                  class="f-13">@lang('Interest Expressed')</span>
                                                        </a>
                                                    @elseif($member->interests->where('interesting_id', $user->id)->where('status', 0)->first())
                                                        <a class="profile-interest-love base-color" href="#">
                                                            <i class="fas fa-heart"></i> <span
                                                                  class="f-13">@lang('Response to Interest')</span>
                                                        </a>
                                                    @elseif($member->interests->where('interesting_id', $user->id)->where('status', 1)->first())
                                                        <a class="profile-interest-love base-color" href="#">
                                                            <i class="fas fa-heart"></i> <span
                                                                  class="f-13">@lang('You Accepted Interest')</span>
                                                        </a>
                                                    @elseif($member->id == $user->id)
                                                        <a class="profile-interest-love" href="javascript:void(0)">
                                                            <i class="fas fa-heart"></i> <span
                                                                  class="f-13">@lang('Interest')</span>
                                                        </a>
                                                    @else
                                                        <a class="profile-interest-love interestExpressBtn"
                                                           data-interesting_id="{{ $member->id }}"
                                                           href="javascript:void(0)">
                                                            <i class="fas fa-heart"></i> <span
                                                                  class="f-13">@lang('Interest')</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="search__right-details">
                                                <div class="row profile-banner__left-details member-details">
                                                    <label class="col-6 d-flex">
                                                        <i class="la la-ring"></i>
                                                        <span>@lang('Marital Status')</span>
                                                    </label>
                                                    <span class="col-6">
                                                        {{ __(@$member->basicInfo->marital_status ?? 'N/A') }}
                                                    </span>
                                                </div>

                                                <div class="row profile-banner__left-details member-details">
                                                    <label class="col-6 d-flex"><i class="las la-search"></i>
                                                        <span>@lang('Looking For')</span>
                                                    </label>
                                                    <span class="col-6">
                                                        @if ($member->looking_for == 1)
                                                            @lang('Male')
                                                        @elseif($member->looking_for == 2)
                                                            @lang('Female')
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="row profile-banner__left-details member-details">
                                                    <label class="col-6 d-flex">
                                                        <i class="las la-flag"></i>
                                                        <span>@lang('Country')</span>
                                                    </label>
                                                    <span class="col-6">
                                                        {{ __(@$member->basicInfo->present_address->country) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="search__right-expression">
                                                <ul class="search__right-list m-0">
                                                    <li class="profile-item">
                                                        @if ($user->shortListedProfile->where('profile_id', $member->id)->first())
                                                            <a class="removeFromShortList base-color"
                                                               data-action="{{ route('user.remove.short.list') }}"
                                                               data-profile_id="{{ $member->id }}"
                                                               href="javascript:void(0)">
                                                                <i class="far fa-star"></i>@lang('Shortlisted')
                                                            </a>
                                                        @elseif($member->id == $user->id)
                                                            <a href="javascript:void(0)">
                                                                <i class="far fa-star"></i>@lang('Shortlist')
                                                            </a>
                                                        @else
                                                            <a class="addToShortList"
                                                               data-action="{{ route('user.add.short.list') }}"
                                                               data-profile_id="{{ $member->id }}"
                                                               data-login="{{ auth()->check() }}"
                                                               href="javascript:void(0)">
                                                                <i class="far fa-star"></i>@lang('Shortlist')
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li class="profile-item">
                                                        @if ($member->id == $user->id)
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-ban"></i>@lang('Ignore')
                                                            </a>
                                                        @else
                                                            <a class="confirmationBtn"
                                                               data-action="{{ route('user.ignore', $member->id) }}"
                                                               data-question="@lang('Are you sure, you want to ignore this member?')"
                                                               href="javascript:void(0)">
                                                                <i class="fas fa-ban"></i>@lang('Ignore')
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li class="profile-item">
                                                        @php
                                                            $report = $user->reports->where('complaint_id', $member->id)->first();
                                                        @endphp
                                                        @if ($report)
                                                            <a class="text--danger reportedUser"
                                                               data-report_reason="{{ __($report->reason) }}"
                                                               data-report_title="{{ __($report->title) }}"
                                                               href="javascript:void(0)">
                                                                <i class="fas fa-info-circle"></i>@lang('Reported')
                                                            </a>
                                                        @elseif($member->id == $user->id)
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-info-circle"></i>@lang('Report')
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                               onclick="showReportModal({{ $member->id }})">
                                                                <i class="fas fa-info-circle"></i>@lang('Report')
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <ul class="nav nav-pills custom--tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="member-details-tab" data-bs-target="#member-detail"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="member-detail"
                                    aria-selected="true"><i class="far fa-user-circle"></i> @lang('Detailed Profile')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="partnerExpectation-tab" data-bs-target="#partnerExpectation"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="partnerExpectation"
                                    aria-selected="false"> <i class="fas fa-chart-line"></i>
                                @lang('Partner Preference')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-target="#pills-contact"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-contact"
                                    aria-selected="false"><i class="far fa-image"></i> @lang('Photo Gallery')</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="member-detail" role="tabpanel"
                             aria-labelledby="member-details-tab">
                            <div class="public-profile__accordion accordion custom--accordion"
                                 id="accordionPanelsStayOpenExample">

                                <!-- Basic information -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-basicInfo">
                                        <button class="accordion-button"
                                                data-bs-target="#panelsStayOpen-collapseBasicInfo" data-bs-toggle="collapse"
                                                type="button" aria-controls="panelsStayOpen-collapseBasicInfo"
                                                aria-expanded="true">
                                            @lang('Basic Information')
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseBasicInfo"
                                         aria-labelledby="panelsStayOpen-basicInfo">
                                        <div class="accordion-body">
                                            <div class="row">
                                                @include($activeTemplate . 'user.members.basic_info')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Basic information end-->

                                @if ($user->id != $member->id)
                                    <!-- Contact Details -->
                                    <div class="accordion-item">
                                        @php
                                            $exist = $user->contacts->where('contact_id', $member->id)->first();
                                        @endphp

                                        <h2 class="accordion-header" id="panelsStayOpen-contactDetails">
                                            <button
                                                    class="accordion-button contact-detail @if (!$exist) collapsed @endif"
                                                    data-bs-target="#panelsStayOpen-collapseContactDetails"
                                                    data-permit="{{ $exist ? 1 : 0 }}" type="button"
                                                    aria-controls="panelsStayOpen-collapseContactDetails"
                                                    aria-expanded="{{ $exist ? 'true' : 'false' }}"
                                                    @if ($exist) data-bs-toggle="collapse" @endif>
                                                @lang('Contact Details')
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse @if ($exist) show @endif"
                                             id="panelsStayOpen-collapseContactDetails"
                                             aria-labelledby="panelsStayOpen-contactDetails">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex flex-wrap">
                                                            <i class="las la-phone mt-1"></i>
                                                            @if ($exist)
                                                                <span class="ps-2">{{ $member->mobile }}</span>
                                                            @else
                                                                <span class="ps-2">xxxxxxxxxxxxxxxxxx</span>
                                                            @endif
                                                        </div>

                                                        <div class="d-flex flex-wrap">
                                                            <i class="las la-envelope mt-1"></i>
                                                            @if ($exist)
                                                                <span class="ps-2">{{ $member->email }}</span>
                                                            @else
                                                                <span class="ps-2">xxxxxxxxxxxxxxxxxx</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Contact Details end-->
                                @endif

                                <!-- Education Info-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-eduInfo">
                                        <button class="accordion-button" data-bs-target="#panelsStayOpen-collapseEduInfo"
                                                data-bs-toggle="collapse" type="button"
                                                aria-controls="panelsStayOpen-collapseEduInfo" aria-expanded="true">
                                            @lang('Education Information')
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseEduInfo"
                                         aria-labelledby="panelsStayOpen-eduInfo">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if ($member->educationInfo->count())
                                                        @foreach ($member->educationInfo as $education)
                                                            <div class="information-item">
                                                                <h6 class="information-item__title mb-2">
                                                                    {{ __($education->institute) }}</h6>
                                                                <div class="information-item__content">
                                                                    <p class="information-item__desc bold mb-0">
                                                                        {{ __($education->degree) }},
                                                                        {{ __($education->field_of_study) }}</p>
                                                                    @if ($education->end)
                                                                        <p class="information-item__desc mb-0">
                                                                            {{ $education->result }} (@lang('Out of - ')
                                                                            {{ $education->out_of }})</p>
                                                                        <p class="information-item__desc mb-0">
                                                                            @lang('Roll No') :
                                                                            {{ $education->roll_no }}, @lang('Registration No')
                                                                            : {{ $education->reg_no }}</p>
                                                                        <p class="information-item__desc mb-0">
                                                                            {{ $education->start }} -
                                                                            {{ $education->end }}</p>
                                                                    @else
                                                                        <p class="information-item__desc mb-0">
                                                                            @lang('Running')</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="empty-table text-center">
                                                            <div class="empty-table__icon">
                                                                <i class="las la-frown"></i>
                                                            </div>
                                                            <h6 class="empty-table__text mt-1">{{ __($emptyMessage) }}
                                                            </h6>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Education Info end -->

                                <!-- Career Info-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-careerInfo">
                                        <button class="accordion-button"
                                                data-bs-target="#panelsStayOpen-collapseCareerInfo" data-bs-toggle="collapse"
                                                type="button" aria-controls="panelsStayOpen-collapseCareerInfo"
                                                aria-expanded="true">
                                            @lang('Career Information')
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseCareerInfo"
                                         aria-labelledby="panelsStayOpen-careerInfo">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if ($member->careerInfo->count())
                                                        @foreach ($member->careerInfo as $career)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h6 class="information-item__title mb-2">
                                                                        {{ __($career->designation) }}</h6>
                                                                    <p class="information-item__desc mb-0">
                                                                        {{ __($career->company) }}</p>
                                                                    @if ($career->end)
                                                                        <p class="information-item__desc mb-0">
                                                                            {{ $education->start }} -
                                                                            {{ $education->end }}</p>
                                                                    @else
                                                                        <p class="information-item__desc mb-0">
                                                                            @lang('Running')</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="empty-table text-center">
                                                            <div class="empty-table__icon">
                                                                <i class="las la-frown"></i>
                                                            </div>
                                                            <h6 class="empty-table__text mt-1">{{ __($emptyMessage) }}
                                                            </h6>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Career Info end -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="partnerExpectation" role="tabpanel"
                             aria-labelledby="partnerExpectation-tab">
                            <div class="card custom--card">
                                <div class="card-body">
                                    <div class="row">
                                        @include($activeTemplate . 'user.members.partner_expectation')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                             aria-labelledby="pills-contact-tab">
                            <div class="row gy-4">
                                @if ($member->galleries->count())
                                    @foreach ($member->galleries as $gallery)
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="profile-gallery">
                                                <div class="profile-gallery__thumb">
                                                    <img
                                                         src="{{ getImage(getFilePath('gallery') . '/' . $gallery->image) }}" /></a>
                                                    <div class="profile-gallery__icon">
                                                        <a class="magnific-gallery"
                                                           href="{{ getImage(getFilePath('gallery') . '/' . $gallery->image) }}"><i
                                                               class="fas fa-search-plus"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="card custom--card">
                                            <div class="empty-table text-center">
                                                <div class="empty-table__icon">
                                                    <i class="las la-frown"></i>
                                                </div>
                                                <h6 class="empty-table__text mt-1">{{ __($emptyMessage) }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- contact detail modal --}}
    <div class="modal custom--modal fade" id="contactDetailModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirm Contact View')</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.contact.view') }}" method="post">
                    @csrf

                    <div class="modal-body">
                        <input name="contact_id" type="hidden">
                        @if (checkValidityPeriod($user->limitation) && ($user->limitation->contact_view_limit == -1 || $user->limitation->contact_view_limit))
                            <div class="text-center">
                                <p class="fw-bold">@lang('Remaining Contact View') : <span class="remainingContactView"></span>
                                    @lang(' times')</p>
                                @if ($user->limitation->contact_view_limit != -1)
                                    <small class="text--danger">**@lang('N.B. Viewing this members contact information will cost 1 from your remaining contact view')**</small>
                                @endif
                            </div>
                        @else
                            <div class="text-center">
                                @if ($user->limitation)
                                    @if (!checkValidityPeriod($user->limitation))
                                        <p class="fw-bold">@lang('Your package has been expired') <span
                                                  class="fw-600">{{ diffForHumans($user->limitation?->expire_date ?? '') }}</span>
                                        </p>
                                    @else
                                        <p class="fw-bold">@lang('Remaining Express Interest') : <span class="remainingContactView"></span>
                                        </p>
                                    @endif
                                @endif
                                @if (gs('default_package_id'))
                                    <small>@lang('Purchase package from ')
                                        <a class="text--base" href="{{ route('packages') }}">@lang('packages')</a>
                                    </small>
                                @else
                                    <small class="text--danger">
                                        @lang('Viewing contact will charge ') <span
                                              class="fw-600">{{ @$general->global_package->contact_view_charge }}
                                            {{ __(gs('cur_text')) }}</span>
                                        @lang('from your balance.')
                                    </small>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if (checkValidityPeriod($user->limitation) && ($user->limitation->contact_view_limit == -1 || $user->limitation->contact_view_limit))
                            <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                        @else
                            <button class="btn btn--dark btn-sm" data-bs-dismiss="modal"
                                    type="button">@lang('Close')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-report-modal />
    <x-report-show-modal />
    <x-interest-express-modal />
    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        "use strict";

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
                interestExpressed: "{{ trans('Interest Expressed') }}",
                expressInterest: "{{ trans('Interest') }}",
            }
        }

        $('.express-interest-form').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');
            let modal = $('#interestExpressModal');
            let id = modal.find('[name=interesting_id]').val();
            let container = $('.profile-interest');
            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(container).find('a').html(
                        ` <i class="fas fa-heart"></i> <span class="f-13">${config.loadingText.interestExpress}..</span>`
                    );
                },
                success: function(response) {
                    modal.modal('hide');
                    if (response.success) {
                        notify('success', response.success);
                        container.find('a').remove();
                        container.html(`<a href="javascript:void(0)" class="profile-interest-love base-color">
                                <i class="fas fa-heart"></i><span class="f-13">${config.buttonText.interestExpressed}</span></a>
                        `);
                    } else {
                        notify('error', response.error);
                        container.html(`
                            <a href="javascript:void(0)" class="profile-interest-love interestExpressBtn" data-interesting_id="${id}">
                                <i class="fas fa-heart"></i><span class="f-13">${config.buttonText.expressInterest}</span>
                            </a>
                        `);
                    }
                }
            });
        });

        //contact view
        let contactDetailBtn = $('.contact-detail');
        contactDetailBtn.on('click', function() {
            let permission = parseInt($(this).data('permit'));

            if (!permission) {
                let modal = $('#contactDetailModal');
                let route = "{{ route('user.contact.limit') }}";
                let contactId = "{{ $member->id }}";
                modal.find('[name=contact_id]').val(contactId);
                $.get(route,
                    function(data) {
                        if (data == '-1') {
                            modal.find('.remainingContactView').text('Unlimited');
                        } else
                            modal.find('.remainingContactView').text(data);
                    }
                );
                modal.modal('show');
            }
        });
    </script>
    <script src="{{ asset($activeTemplateTrue . 'js/member.js') }}"></script>
@endpush
