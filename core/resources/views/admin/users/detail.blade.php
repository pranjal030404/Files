@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <div class="card bg--primary has-link overflow-hidden box--shadow2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <i class="las la-box-open f-size--56"></i>
                        </div>
                        <div class="col-8 text-end">
                            <span class="text-white text--small">@lang('Active Package')</span>
                            <h2 class="text-white">{{ __(@$user->limitation->package->name ?? 'N/A') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <div class="card bg--12 has-link box--shadow2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <i class="las la-heart f-size--56"></i>
                        </div>
                        <div class="col-8 text-end">
                            <span class="text-white text--small">@lang('Remaining Interest')</span>
                            <h2 class="text-white">{{ userLimitation($user->limitation)['interest_express_limit'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <div class="card bg--3 has-link box--shadow2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <i class="las la-phone-alt f-size--56"></i>
                        </div>
                        <div class="col-8 text-end">
                            <span class="text-white text--small">@lang('Remaining Contact View')</span>
                            <h2 class="text-white">{{ userLimitation($user->limitation)['contact_view_limit'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <div class="card bg--dark has-link box--shadow2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <i class="las la-images f-size--56"></i>
                        </div>
                        <div class="col-8 text-end">
                            <span class="text-white text--small">@lang('Remaining Image Upload')</span>
                            <h2 class="text-white">{{ @$user->limitation->image_upload_limit == -1 ? trans('Unlimited') : (@$user->limitation->image_upload_limit - $user->total_images > 0 ? @$user->limitation->image_upload_limit - $user->total_images : 0) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->
    <div class="row mt-4">

        <div class="col-12">
            <div class="d-flex flex-wrap gap-3">

                <div class="flex-fill">
                    <a class="btn btn--primary btn--shadow w-100 btn-lg" href="{{ route('admin.report.login.history') }}?search={{ $user->username }}">
                        <i class="las la-list-alt"></i>@lang('Logins')
                    </a>
                </div>

                <div class="flex-fill">
                    <a class="btn btn--secondary btn--shadow w-100 btn-lg" href="{{ route('admin.users.notification.log', $user->id) }}">
                        <i class="las la-bell"></i>@lang('Notifications')
                    </a>
                </div>


                @if ($user->kyc_data)
                    <div class="flex-fill">
                        <a class="btn btn--dark btn--shadow w-100 btn-lg" href="{{ route('admin.users.kyc.details', $user->id) }}" target="_blank">
                            <i class="las la-user-check"></i>@lang('KYC Data')
                        </a>
                    </div>
                @endif

                <div class="flex-fill">
                    @if ($user->status == Status::USER_ACTIVE)
                        <button class="btn btn--warning btn--shadow w-100 btn-lg userStatus" data-bs-target="#userStatusModal" data-bs-toggle="modal" type="button">
                            <i class="las la-ban"></i>@lang('Ban User')
                        </button>
                    @else
                        <button class="btn btn--success btn--shadow w-100 btn-lg userStatus" data-bs-target="#userStatusModal" data-bs-toggle="modal" type="button">
                            <i class="las la-undo"></i>@lang('Unban User')
                        </button>
                    @endif
                </div>

                @if ($reports)
                    <div class="flex-fill">
                        <a class="btn btn--danger btn--shadow w-100 btn-lg" href="{{ route('admin.user.reports') }}?search={{ $user->username }}">
                            <i class="la la-list"></i>@lang('Reports')
                        </a>
                    </div>
                @endif
            </div>

            @if ($reports)
                <div class="card mt-30">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Reports')
                        </h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            @endif

            <div class="card mt-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Information of') {{ $user->fullname }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('First Name')</label>
                                    <input class="form-control" name="firstname" required type="text" value="{{ $user->firstname }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('Last Name')</label>
                                    <input class="form-control" name="lastname" required type="text" value="{{ $user->lastname }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input class="form-control" name="email" required type="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Mobile Number')</label>
                                    <div class="input-group ">
                                        <span class="input-group-text mobile-code"></span>
                                        <input class="form-control checkUser" id="mobile" name="mobile" required type="number" value="{{ old('mobile') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label>@lang('Address')</label>
                                    <input class="form-control" name="address" type="text" value="{{ @$user->address }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('City')</label>
                                    <input class="form-control" name="city" type="text" value="{{ @$user->city }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('State')</label>
                                    <input class="form-control" name="state" type="text" value="{{ @$user->state }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Zip/Postal')</label>
                                    <input class="form-control" name="zip" type="text" value="{{ @$user->zip }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('Country')</label>
                                    <select class="form-control" name="country">
                                        @foreach ($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}">{{ __($country->country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group  col-xl-4 col-md-4 col-12">
                                <label>@lang('Email Verification')</label>
                                <input @if ($user->ev) checked @endif data-bs-toggle="toggle" data-off="@lang('Unverified')" data-offstyle="-danger" data-on="@lang('Verified')" data-onstyle="-success" data-width="100%" name="ev" type="checkbox">

                            </div>
                            <div class="form-group  col-xl-4 col-md-4 col-12">
                                <label>@lang('Mobile Verification')</label>
                                <input @if ($user->sv) checked @endif data-bs-toggle="toggle" data-off="@lang('Unverified')" data-offstyle="-danger" data-on="@lang('Verified')" data-onstyle="-success" data-width="100%" name="sv" type="checkbox">

                            </div>
                            <div class="form-group col-xl-4 col-md-4 col-12">
                                <label>@lang('KYC') </label>
                                <input @if ($user->kv == 1) checked @endif data-bs-toggle="toggle" data-height="50" data-off="@lang('Unverified')" data-offstyle="-danger" data-on="@lang('Verified')" data-onstyle="-success" data-width="100%" name="kv" type="checkbox">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="userStatusModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($user->status == Status::USER_ACTIVE)
                            <span>@lang('Ban User')</span>
                        @else
                            <span>@lang('Unban User')</span>
                        @endif
                    </h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($user->status == Status::USER_ACTIVE)
                            <h6 class="mb-2">@lang('If you ban this user he/she won\'t able to access his/her dashboard.')</h6>
                            <div class="form-group">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="reason" required rows="4"></textarea>
                            </div>
                        @else
                            <p><span>@lang('Ban reason was'):</span></p>
                            <p>{{ $user->ban_reason }}</p>
                            <h4 class="text-center mt-3">@lang('Are you sure to unban this user?')</h4>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if ($user->status == Status::USER_ACTIVE)
                            <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                        @else
                            <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                            <button class="btn btn--primary" type="submit">@lang('Yes')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{route('admin.users.login',$user->id)}}" target="_blank" class="btn btn-sm btn-outline--primary" ><i class="las la-sign-in-alt"></i>@lang('Login as User')</a>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict"
            let mobileElement = $('.mobile-code');
            $('select[name=country]').change(function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });

            $('select[name=country]').val('{{ @$user->country_code }}');
            let dialCode = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber = `{{ $user->mobile }}`;
            mobileNumber = mobileNumber.replace(dialCode, '');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);

        })(jQuery);
    </script>
@endpush
