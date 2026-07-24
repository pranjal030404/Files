@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-10">
        <div class="card custom--card">
            <h5 class="card-header mt-0">@lang('Stripe Hosted')</h5>
            <div class="card-body">
                <div class="card-wrapper mb-3"></div>
                <form role="form" class="disableSubmission payment appPayment" id="payment-form" method="{{ $data->method }}" action="{{ $data->url }}">
                    @csrf
                    <input name="track" type="hidden" value="{{ $data->track }}">
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="input--group">
                                <div class="input-group">
                                    <input class="form-control form--control" name="name" type="text" value="{{ old('name') }}" autocomplete="off" placeholder="@lang('Name on Card')" autofocus required />
                                    <span class="input-group-text"><i class="fa fa-font"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input--group">
                                <div class="input-group">
                                    <input class="form-control form--control" name="cardNumber" type="tel" value="{{ old('cardNumber') }}" autocomplete="off" placeholder="@lang('Card Number')" autofocus required />
                                    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input--group">
                                <input class="form-control form--control" name="cardExpiry" type="tel" value="{{ old('cardExpiry') }}" autocomplete="off" required />
                                <label class="form--label">@lang('Expiration Date')</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input--group">
                                <input class="form-control form--control" name="cardCVC" type="tel" value="{{ old('cardCVC') }}" autocomplete="off" required />
                                <label class="form--label">@lang('CVC Code')</label>
                            </div>
                        </div>
                        <button class="btn btn--base w-100" type="submit"> @lang('Submit')</button>
                    </div>
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
