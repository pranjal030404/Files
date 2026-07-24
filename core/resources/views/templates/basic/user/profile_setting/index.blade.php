@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-4">
        <div class="col-12">
            <!--Basic information-->
            @include($activeTemplate . 'user.profile_setting.basic')
        </div>

        <div class="col-12">
            <!--Partner Expectation-->
            @include($activeTemplate . 'user.profile_setting.partner_expectation')
        </div>
        <div class="col-12">
            <!--Physical attributes-->
            @include($activeTemplate . 'user.profile_setting.physical_attributes')
        </div>

        <div class="col-12">
            <!--Family Info-->
            @include($activeTemplate . 'user.profile_setting.family')
        </div>

        <div class="col-12">
            <!--Career Info-->
            @include($activeTemplate . 'user.profile_setting.career')
        </div>

        <div class="col-12">
            <!--Education Info-->
            @include($activeTemplate . 'user.profile_setting.education')
        </div>
    </div>
@endsection

@push('style-lib')
    <link href="{{ asset('assets/global/css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $.each($('.select2'), function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });

            $.each($('.select2-auto-tokenize'), function() {
                $(this).select2({
                    tags: true,
                    tokenSeparators: [','],
                    dropdownParent: $(this).parent()
                });
            });
        })(jQuery)
    </script>
@endpush
