@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-10">
        <div class="card custom--card">
            <h5 class="card-header mt-0">@lang('Authorize Net')</h5>
            <div class="card-body">
                <div class="card-wrapper mb-3"></div>
                <form role="form" class="disableSubmission appPayment" id="payment-form" method="{{ $data->method }}" action="{{ $data->url }}">
                    @csrf
                    <input name="track" type="hidden" value="{{ $data->track }}">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">@lang('Name on Card')</label>
                            <div class="input-group">
                                <input autocomplete="off" autofocus class="form-control form--control" name="name" required type="text" value="{{ old('name') }}" />
                                <span class="input-group-text"><i class="fa fa-font"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('Card Number')</label>
                            <div class="input-group">
                                <input autocomplete="off" autofocus class="form-control form--control" name="cardNumber" required type="tel" value="{{ old('cardNumber') }}" />
                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label class="form-label">@lang('Expiration Date')</label>
                            <input autocomplete="off" class="form-control form--control" name="cardExpiry" required type="tel" value="{{ old('cardExpiry') }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('CVC Code')</label>
                            <input autocomplete="off" class="form-control form--control" name="cardCVC" required type="tel" value="{{ old('cardCVC') }}" />
                        </div>
                    </div>
                    <br>
                    <button class="btn btn--base w-100" type="submit"> @lang('Submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/card.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            var card = new Card({
                form: '#payment-form',
                container: '.card-wrapper',
                formSelectors: {
                    numberInput: 'input[name="cardNumber"]',
                    expiryInput: 'input[name="cardExpiry"]',
                    cvcInput: 'input[name="cardCVC"]',
                    nameInput: 'input[name="name"]'
                }
            });

            @if ($deposit->from_api)
                $('.appPayment').on('submit', function() {
                    $(this).find('[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                })
            @endif
        })(jQuery);
    </script>
@endpush
