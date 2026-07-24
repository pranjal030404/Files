@php
    use App\Constants\Status;$packageContent = getContent('package.content', true);
    $gatewayCurrency = \App\Models\GatewayCurrency::whereHas('method', function ($gate) {
        $gate->where('status', Status::ENABLE);
    })
        ->with('method')
        ->orderby('method_code')
        ->get();
@endphp
<div class="section pricing-plan section--bg">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$packageContent->data_values->heading) }}</h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        {{ __(@$packageContent->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-4 g-xl-3 g-xxl-4 justify-content-center">
            @foreach ($packages as $package)
                <div class="col-md-6 col-xl-3">
                    <div class="plan">
                        <div class="plan__head">
                            <div class="plan__head-content">
                                <h4 class="text--white mt-0 mb-0 text-center">{{ __($package->name) }}</h4>
                            </div>
                        </div>
                        <div class="plan__body">
                            <div class="text-center">
                                <h5 class="plan__body-price m-0 text-center">{{ showAmount($package->price) }}
                                   </h5>
                            </div>
                            <ul class="list list--base">
                                <li>
                                    <i class="text--base @if ($package->validity_period) fas fa-check @else fas fa-times @endif"></i>
                                    @lang('Duration') {{ packageLimitation($package)['validity_period'] }}
                                </li>

                                <li>
                                    <i class="text--base @if ($package->contact_view_limit) fas fa-check @else fas fa-times @endif"></i>
                                    @lang('Contact View') {{ packageLimitation($package)['contact_view_limit'] }}
                                </li>

                                <li>
                                    <i class="text--base @if ($package->interest_express_limit) fas fa-check @else fas fa-times @endif"></i>
                                    @lang('Interest Express') {{ packageLimitation($package)['interest_express_limit'] }}
                                </li>

                                <li>
                                    <i class="text--base @if ($package->image_upload_limit) fas fa-check @else fas fa-times @endif"></i>
                                    @lang('Image Upload') {{ packageLimitation($package)['image_upload_limit'] }}
                                </li>
                            </ul>
                            <div class="mt-3 text-center">
                                @if ($package->id == (gs('default_package_id')))
                                    <button class="btn btn--base sm-text" type="button" disabled>
                                        @lang('Buy Now') </button>
                                @else
                                    <button class="btn btn--base sm-text packageBtn boostBtn" data-package_id="{{ $package->id }}"
                                            type="button"> @lang('Buy Now') </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($totalPackage > $packages->count())
            <div class="mt-5 text-center">
                <a class="btn btn--base" href="{{ route('packages') }}">@lang('See More')</a>
            </div>
        @endif
    </div>
</div>

<div id="boostModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Confirmation Alert!')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{ route('user.payment.buy.package') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>@lang('Are you sure to purchase this package?')</p>
                </div>
                <input type="hidden" name="package_id">
                <input type="hidden" name="coupon_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn-sm" data-bs-dismiss="modal">@lang('No')</button>
                    <button type="submit" class="btn btn--base btn-sm">@lang('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--<div class="modal fade" id="purchaseModal" role="dialog" aria-hidden="true" aria-labelledby="purchaseModalTitle"--}}
{{--     tabindex="-1">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="existModalLongTitle">@lang('Purchase Package -') <span--}}
{{--                        class="package-name"></span></h5>--}}
{{--                <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">--}}
{{--                    <i class="las la-times"></i>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--            <form action="" method="post">--}}
{{--                @csrf--}}
{{--                <input name="method_code" type="hidden">--}}
{{--                <input name="currency" type="hidden">--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="input--group">--}}
{{--                                <select class="form-select form-control form--control" name="gateway" required>--}}
{{--                                    <option value="">@lang('Select One')</option>--}}
{{--                                    @foreach ($gatewayCurrency as $data)--}}
{{--                                        <option data-gateway="{{ $data }}"--}}
{{--                                                value="{{ $data->method_code }}" @selected(old('gateway') == $data->method_code)>{{ $data->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <label class="form--label">@lang('Gateway')</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12 preview-details d-none mt-3">--}}
{{--                            <ul class="list-group">--}}
{{--                                <li class="list-group-item d-flex justify-content-between">--}}
{{--                                    <span>@lang('Limit')</span>--}}
{{--                                    <span>--}}
{{--                                        <span class="min">0</span> {{ __(gs('cur_text')) }} - <span--}}
{{--                                            class="max">0</span> {{ __(gs('cur_text')) }}--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item d-flex justify-content-between">--}}
{{--                                    <span>@lang('Charge')</span>--}}
{{--                                    <span><span class="charge">0</span> {{ __(gs('cur_text')) }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item d-flex justify-content-between">--}}
{{--                                    <span>@lang('Payable')</span> <span><span class="payable"> 0</span>--}}
{{--                                        {{ __(gs('cur_text')) }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item justify-content-between d-none rate-element">--}}

{{--                                </li>--}}
{{--                                <li class="list-group-item justify-content-between d-none in-site-cur">--}}
{{--                                    <span>@lang('In') <span class="base-currency"></span></span>--}}
{{--                                    <span class="final_amo">0</span>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item justify-content-center crypto_currency d-none">--}}
{{--                                    <span>@lang('Conversion with') <span class="method_currency"></span>--}}
{{--                                        @lang('and final value will Show on next step')</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <p class="text--danger limit-message d-none mb-0 pt-2 text-center"></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn--base w-100 submit-btn" type="submit">@lang('Submit')</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@push('style')
    <style>
        .modal .btn {
            padding: 5px 10px !important;
        }

        .modal-title {
            margin: 0;
        }

        .modal-header {
            padding: 13px 15px;
        }

        .modal-body h6 {
            margin: 1rem 1rem;
        }

        .list-group-item {
            color: unset;
            font-size: 14px;
        }
    </style>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $(document).on('click','.boostBtn', function () {
                var modal   = $('#boostModal');
                let data    = $(this).data();
                modal.find('[name=package_id]').val(data.package_id);
                modal.modal('show');
            });
        })(jQuery);
        {{--(function ($) {--}}
        {{--    "use trict";--}}

        {{--    let amount = 0;--}}
        {{--    let modal = $('#purchaseModal');--}}
        {{--    $('.packageBtn').on('click', function () {--}}
        {{--        let package = $(this).data('package');--}}

        {{--        let url = `{{ route('user.payment.purchase.package', ':id') }}`;--}}
        {{--        let gateway = modal.find('[name=gateway]');--}}
        {{--        gateway.val('');--}}

        {{--        url = url.replaceAll(":id", package.id);--}}
        {{--        modal.find('form').attr('action', url);--}}

        {{--        modal.find('.package-name').text(package.name);--}}
        {{--        amount = package.price;--}}
        {{--        modal.find('[name=amount]').val(amount);--}}
        {{--        modal.find('.preview-details').addClass('d-none');--}}
        {{--        modal.modal('show');--}}
        {{--    });--}}

        {{--    modal.find('select[name=gateway]').change(function () {--}}
        {{--        if (!modal.find('select[name=gateway]').val()) {--}}
        {{--            modal.find('.preview-details').addClass('d-none');--}}
        {{--            return false;--}}
        {{--        }--}}
        {{--        var resource = modal.find('select[name=gateway] option:selected').data('gateway');--}}

        {{--        var fixed_charge = parseFloat(resource.fixed_charge);--}}
        {{--        var percent_charge = parseFloat(resource.percent_charge);--}}
        {{--        var rate = parseFloat(resource.rate)--}}
        {{--        if (resource.method.crypto == 1) {--}}
        {{--            var toFixedDigit = 8;--}}
        {{--            modal.find('.crypto_currency').removeClass('d-none');--}}
        {{--        } else {--}}
        {{--            var toFixedDigit = 2;--}}
        {{--            modal.find('.crypto_currency').addClass('d-none');--}}
        {{--        }--}}
        {{--        modal.find('.min').text(parseFloat(resource.min_amount).toFixed(2));--}}
        {{--        modal.find('.max').text(parseFloat(resource.max_amount).toFixed(2));--}}

        {{--        modal.find('.preview-details').removeClass('d-none');--}}
        {{--        var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);--}}
        {{--        modal.find('.charge').text(charge);--}}

        {{--        var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);--}}
        {{--        modal.find('.payable').text(payable);--}}

        {{--        if (parseFloat(payable) > parseFloat(resource.max_amount)) {--}}
        {{--            $('.limit-message').text('Payable amount exceeds the limit, please try another gateway');--}}
        {{--            $('.submit-btn').attr('disabled', true);--}}
        {{--            $('.limit-message').removeClass('d-none');--}}
        {{--        } else {--}}
        {{--            $('.limit-message').addClass('d-none');--}}
        {{--            $('.submit-btn').attr('disabled', false);--}}
        {{--        }--}}

        {{--        var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge))) * rate).toFixed(toFixedDigit);--}}
        {{--        modal.find('.final_amo').text(final_amo);--}}

        {{--        if (resource.currency != '{{ (gs('cur_text')) }}') {--}}
        {{--            var rateElement =--}}
        {{--                `<span class="">@lang('Conversion Rate')</span> <span><span  class="">1 {{ __(gs('cur_text')) }} = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span></span>`;--}}
        {{--            modal.find('.rate-element').html(rateElement)--}}
        {{--            modal.find('.rate-element').removeClass('d-none');--}}
        {{--            modal.find('.in-site-cur').removeClass('d-none');--}}
        {{--            modal.find('.rate-element').addClass('d-flex');--}}
        {{--            modal.find('.in-site-cur').addClass('d-flex');--}}
        {{--        } else {--}}
        {{--            modal.find('.rate-element').html('')--}}
        {{--            modal.find('.rate-element').addClass('d-none');--}}
        {{--            modal.find('.in-site-cur').addClass('d-none');--}}
        {{--            modal.find('.rate-element').removeClass('d-flex');--}}
        {{--            modal.find('.in-site-cur').removeClass('d-flex');--}}
        {{--        }--}}
        {{--        modal.find('.base-currency').text(resource.currency);--}}
        {{--        modal.find('.method_currency').text(resource.currency);--}}
        {{--        modal.find('input[name=currency]').val(resource.currency);--}}
        {{--        modal.find('input[name=method_code]').val(resource.method_code);--}}
        {{--    });--}}
        {{--})(jQuery);--}}
        (function ($) {
            "use strict";

            $('.packageBtn').on('click', function () {
                let packageId = $(this).data('package').id;
                let url = `{{ route('user.payment.buy.package', ':id') }}`;
                url = url.replace(':id', packageId);
                window.location.href = url;
            });
        })(jQuery);
    </script>
@endpush
