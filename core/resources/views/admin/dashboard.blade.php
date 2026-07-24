@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="1" value="{{ $widget['total_users'] }}" title="Total Users" link="{{ route('admin.users.all') }}" icon="las la-users f-size--56" bg="primary" />
        </div>

        <div class="col-xxl-3 col-sm-6">
            <x-widget style="1" value="{{ $widget['verified_users'] }}" title="Active Users" link="{{ route('admin.users.active') }}" icon="las la-user-check f-size--56" bg="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="1" value="{{ $widget['email_unverified_users'] }}" title="Email Unverified Users" link="{{ route('admin.users.email.unverified') }}" icon="lar la-envelope f-size--56" bg="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="1" value="{{ $widget['mobile_unverified_users'] }}" title="Mobile Unverified Users" link="{{ route('admin.users.mobile.unverified') }}" icon="las la-comment-slash f-size--56" bg="red" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" value="{{ showAmount($deposit['total_deposit_amount']) }}" title="Total Payment" link="{{ route('admin.deposit.list') }}" icon="las la-hand-holding-usd" icon_style="false" color="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" value="{{ showAmount($deposit['total_deposit_pending']) }}" title="Pending Payments" link="{{ route('admin.deposit.pending') }}" icon="las la-spinner" icon_style="false" color="warning" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" value="{{ showAmount($deposit['total_deposit_rejected']) }}" title="Rejected Payments" link="{{ route('admin.deposit.rejected') }}" icon="las la-ban" icon_style="false" color="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" value="{{ showAmount($deposit['total_deposit_charge']) }}" title="Payment Charge" link="{{ route('admin.deposit.rejected') }}" icon="las la-percentage" icon_style="false" color="primary" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" link="{{ route('admin.report.purchase.history') }}" icon="las la-cubes" title="Purchased Package" value="{{ showAmount($widget['purchasedAmount']) }}" color="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" link="{{ route('admin.user.interests') }}" icon="las la-heart" title="Total Interests" value="{{ $widget['totalInterests'] }}" color="pink" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" link="{{ route('admin.user.ignored.profile') }}" icon="las la-heart-broken" title="Ignored Profiles" value="{{ $widget['totalIgnoredProfiles'] }}" color="red" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" cover_cursor="1" link="{{ route('admin.user.ignored.profile') }}" icon="las la-exclamation-triangle" title="Reports" value="{{ $widget['totalReports'] }}" color="dark" />
        </div>
    </div>

    <div class="row mb-none-30 mt-4">
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Browser') (@lang('Last 30 days'))</h5>
                    <canvas id="userBrowserChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By OS') (@lang('Last 30 days'))</h5>
                    <canvas id="userOsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Country') (@lang('Last 30 days'))</h5>
                    <canvas id="userCountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/charts.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
@endpush

@push('script')
    <script>
        "use strict";

        piChart(
            document.getElementById('userBrowserChart'),
            @json(@$chart['user_browser_counter']->keys()),
            @json(@$chart['user_browser_counter']->flatten())
        );

        piChart(
            document.getElementById('userOsChart'),
            @json(@$chart['user_os_counter']->keys()),
            @json(@$chart['user_os_counter']->flatten())
        );

        piChart(
            document.getElementById('userCountryChart'),
            @json(@$chart['user_country_counter']->keys()),
            @json(@$chart['user_country_counter']->flatten())
        );
    </script>
@endpush
@push('style')
    <style>
        .apexcharts-menu {
            min-width: 120px !important;
        }
    </style>
@endpush
