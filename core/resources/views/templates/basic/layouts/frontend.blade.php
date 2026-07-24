@extends($activeTemplate . 'layouts.app')
@section('panel')
    @stack('fbComment')

    <div class="preloader">
        <div class="preloader__loader">
            <i class="las la-heart"></i>
        </div>
    </div>
    <div class="back-to-top">
        <span class="back-top">
            <i class="las la-angle-double-up"></i>
        </span>
    </div>
    <div class="body-overlay" id="body-overlay"></div>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="search-popup" id="search-popup">
        <form class="search-form" action="#">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Search....." />
            </div>
            <button class="submit-btn xl-text" type="submit">
                <i class="las la-search"></i>
            </button>
        </form>
    </div>
    <div class="toggle-overlay"></div>

    @if(!request()->routeIs('maintenance-mode') && gs('maintenance_mode') == \App\Constants\Status::DISABLE)
        @include($activeTemplate . 'partials.header_top')
    @endif
    @include($activeTemplate . 'partials.header')
    @yield('content')

    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp
    @if ($cookie->data_values->status == Status::ENABLE && !\Cookie::get('gdpr_cookie'))
        <div class="cookies-card hide text-center">
            <div class="cookies-card__icon bg--base">
                <i class="las la-cookie-bite"></i>
            </div>
            <p class="cookies-card__content mt-4">{{ __($cookie->data_values->short_desc) }}
                <a href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a>
            </p>
            <button class="btn btn--base w-100 policy mt-3" type="button">@lang('Allow')</button>
        </div>
    @endif

    @include($activeTemplate . 'partials.footer')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

        })(jQuery);
    </script>
@endpush
