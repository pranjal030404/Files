@extends($activeTemplate . 'layouts.master')
@section('content')

    @if (auth()->user()->kv != Status::KYC_VERIFIED)
        @php
            $kyc = getContent('kyc.content', true);
        @endphp
        @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
            <div class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="alert-heading my-0">@lang('KYC Documents Rejected')</h6>
                    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#kycRejectionReason">@lang('Show Reason')</button>
                </div>
                <hr class="my-2">
                <p class="mb-0">{{ __(@$kyc->data_values->reject) }} <a
                       href="{{ route('user.kyc.form') }}">@lang('Click Here to Re-submit Documents')</a>.</p>
                <br>
                <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>
            </div>
        @elseif(auth()->user()->kv == Status::KYC_UNVERIFIED)
            <div class="alert alert-info" role="alert">
                <h6 class="alert-heading my-0">@lang('KYC Verification required')</h6>
                <hr class="my-2">
                <p class="mb-0">{{ __(@$kyc->data_values->required) }} <a
                       href="{{ route('user.kyc.form') }}">@lang('Click Here to Submit Documents')</a></p>
            </div>
        @elseif(auth()->user()->kv == Status::KYC_PENDING)
            <div class="alert alert-warning" role="alert">
                <h6 class="alert-heading my-0">@lang('KYC Verification pending')</h6>
                <hr class="my-2">
                <p class="mb-0">{{ __(@$kyc->data_values->pending) }} <a
                       href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
            </div>
        @endif
    @endif
    <!-- Dashboard  -->
    <div class="row gy-4 justify-content-center">
        <div class="dashboard-wrapper col-xxl-4 col-md-6">
            <div class="dashboard-card d-flex align-items-center flex-wrap">
                <div class="dashboard-card__icon">
                    <i class="far fa-heart"></i>
                </div>
                <div class="dashboard-card__content text-start">
                    <h4 class="dashboard-card__title d-block mt-0">{{ userLimitation()['interest_express_limit'] }}</h4>
                    <span class="dashboard-card__desc">@lang('Remaining Interests')</span>
                </div>
            </div>
        </div>
        <div class="dashboard-wrapper col-xxl-4 col-md-6">
            <div class="dashboard-card d-flex align-items-center flex-wrap">
                <div class="dashboard-card__icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="dashboard-card__content text-start">
                    <h4 class="dashboard-card__title d-block mt-0">{{ userLimitation()['contact_view_limit'] }}</h4>
                    <span class="dashboard-card__desc">@lang('Remaining Contact View')</span>
                </div>
            </div>
        </div>
        <div class="dashboard-wrapper col-xxl-4 col-md-6">
            <div class="dashboard-card d-flex align-items-center flex-wrap">
                <div class="dashboard-card__icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="dashboard-card__content text-start">
                    <h4 class="dashboard-card__title d-block mt-0">
                        {{ @$user->limitation->image_upload_limit == -1 ? trans('Unlimited') : (@$user->limitation->image_upload_limit - @$user->total_images > 0 ? @$user->limitation->image_upload_limit - @$user->total_images : 0) }}
                    </h4>
                    <span class="dashboard-card__desc">@lang('Remaining Image Upload')</span>
                </div>
            </div>
        </div>
        <div class="dashboard-wrapper col-xxl-4 col-md-6">
            <div class="dashboard-card d-flex align-items-center flex-wrap">
                <div class="dashboard-card__icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="dashboard-card__content text-start">
                    <h4 class="dashboard-card__title d-block mt-0">{{ $user->totalShortlisted }}</h4>
                    <span class="dashboard-card__desc">@lang('Total Shortlisted')</span>
                </div>
            </div>
        </div>
        <div class="dashboard-wrapper col-xxl-4 col-md-6">
            <div class="dashboard-card d-flex align-items-center flex-wrap">
                <div class="dashboard-card__icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="dashboard-card__content text-start">
                    <h4 class="dashboard-card__title d-block mt-0">{{ $user->interestSent }}</h4>
                    <span class="dashboard-card__desc">@lang('Interest Sent')</span>
                </div>
            </div>
        </div>
        <div class="dashboard-wrapper col-xxl-4 col-md-6">
            <div class="dashboard-card d-flex align-items-center flex-wrap">
                <div class="dashboard-card__icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="dashboard-card__content text-start">
                    <h4 class="dashboard-card__title d-block mt-0">{{ $user->totalInterestRequests }}</h4>
                    <span class="dashboard-card__desc">@lang('Interest Requests')</span>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card custom--card package--card">
                <h5 class="card-header mt-0">@lang('Current Package')</h5>
                <div class="card-body">
                    <div class="row">
                        <h5>{{ __(@$user->limitation->package_id ? @$user->limitation->package->name : 'Global Package') }}
                        </h5>
                        <div class="package-options d-flex flex-wrap">
                            <i class="las la-check mt-1"></i>
                            <span class="ps-2">
                                @if (@$user->limitation->interest_express_limit != -1)
                                    {{ @$user->limitation->interest_express_limit }}
                                @else
                                    @lang('Unlimited ')
                                @endif
                                @lang('Express Interests')
                            </span>
                        </div>
                        <div class="package-options d-flex mt-1 flex-wrap">
                            <i class="las la-check mt-1"></i>
                            <span class="ps-2">
                                {{ @$user->limitation->contact_view_limit == -1 ? 'Unlimited ' : @$user->limitation->contact_view_limit }}
                                @lang('Contact View')
                            </span>
                        </div>

                        <div class="package-options d-flex mt-1 flex-wrap">
                            <i class="las la-check mt-1"></i>
                            <span class="ps-2">
                                {{ @$user->limitation->image_upload_limit == -1 ? 'Unlimited ' : @$user->limitation->image_upload_limit }}
                                @lang('Image Upload')
                            </span>
                        </div>
                        <div class="mt-3">
                            @if ($user->limitation)
                                <div>
                                    @if (checkValidityPeriod($user->limitation))
                                        @lang('Package expiry date') : {{ showDateTime($user->limitation->expire_date, 'd M, Y') }}
                                    @else
                                        @lang('Package expired') : {{ diffForHumans($user->limitation?->expire_date) }}
                                    @endif
                                </div>
                            @endif
                            <a class="btn btn--base mt-3" href="{{ route('packages') }}">@lang('Upgrade Package')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <h5>@lang('Latest Interests')</h5>
            @include($activeTemplate . 'partials.interest_table', [
                'interests' => $user->interests,
                'pagination' => false,
            ])
        </div>
        <div class="col-md-12">
            <h5>@lang('Latest Interest Requests')</h5>
            @include($activeTemplate . 'partials.interest_request_table', [
                'interestRequests' => $user->interestRequests,
                'pagination' => false,
            ])
        </div>
    </div>
    <!-- Dashboard End -->

    @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
        <div class="modal custom--modal fade" id="kycRejectionReason">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ auth()->user()->kyc_rejection_reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('style')
    <style>
        .wallet--card.custom--card .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush
