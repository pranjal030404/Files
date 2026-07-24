@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="col-md-10">
        <div class="card custom--card">
            <h5 class="card-header mt-0"> {{ __($data->gateway->name) }}</h5>
            <div class="card-body">
                <form action="{{ route('user.payment.manual.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-12 text-center">
                            <p class="mt-2 text-center">@lang('You have requested') <b class="text-success">{{ showAmount($data['amount']) }} {{ __(gs('cur_text')) }}</b> , @lang('Please pay')
                                <b class="text-success">{{ showAmount($data['final_amount'], currencyFormat:false) . ' ' . $data['method_currency'] }} </b> @lang('for successful payment')
                            </p>
                            <h4 class="mb-4 text-center">@lang('Please follow the instruction below')</h4>

                            <p class="my-4 text-center">@php echo  $data->gateway->description @endphp</p>

                        </div>

                        <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />

                        <button class="btn btn--base w-100 mt-0" type="submit">@lang('Pay Now')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
