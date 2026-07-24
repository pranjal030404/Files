@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-10">
        <div class="card custom--card">
            <h5 class="card-header mt-0">@lang('NMI')</h5>
            <div class="card-body">
                <form role="form" class="disableSubmission appPayment" id="payment-form" method="{{ $data->method }}" action="{{ $data->url }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">@lang('Card Number')</label>
                            <div class="input-group">
                                <input autocomplete="off" autofocus class="form-control form--control" name="billing-cc-number" required type="tel" value="{{ old('billing-cc-number') }}" />
                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label class="form-label">@lang('Expiration Date')</label>
                            <input autocomplete="off" class="form-control form--control" name="billing-cc-exp" placeholder="e.g. MM/YY" required type="tel" value="{{ old('billing-cc-exp') }}" />
                        </div>
                        <div class="col-md-6 ">
                            <label class="form-label">@lang('CVC Code')</label>
                            <input autocomplete="off" class="form-control form--control" name="billing-cc-cvv" required type="tel" value="{{ old('billing-cc-cvv') }}" />
                        </div>
                    </div>
                    <br>
                    <button class="btn btn--base w-100" type="submit"> @lang('Submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@if ($deposit->from_api)
    @push('script')
        <script>
            (function($) {
                "use strict";

                $('.appPayment').on('submit', function() {
                    $(this).find('[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                });
            })(jQuery);
        </script>
    @endpush
@endif
