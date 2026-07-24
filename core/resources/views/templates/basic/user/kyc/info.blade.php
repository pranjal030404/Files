@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-lg-12">
                <div class="card custom--card">
                    <div class="card-body p-0">
                        @if ($user->kyc_data)
                            <ul class="list-group list-group-flush">
                                @foreach ($user->kyc_data as $val)
                                    @continue(!$val->value)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ __($val->name) }}</span>
                                        <span>
                                            @if ($val->type == 'checkbox')
                                                {{ implode(',', $val->value) }}
                                            @elseif($val->type == 'file')
                                                <a href="{{ route('user.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                            @else
                                                <p class="my-0">{{ __($val->value) }}</p>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h5 class="text-center">@lang('KYC data not found')</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .list-group-flush {
            border: 1px solid hsl(var(--border)/ 0.2);
            border-radius: 5px;
        }

        .list-group-flush>.list-group-item {
            border-color: hsl(var(--border)/0.3);
        }

        .list-group-item span {
            font-size: 14px;
        }
    </style>
@endpush
