@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-6">
                    <div class="card login__wrapper custom--card">
                        <h5 class="login-title pb-3 text-center">@lang('You are banned')</h5>
                        <div class="card-body p-0">
                            <p class="fw-bold mb-1">@lang('Reason'):</p>
                            <p>{{ $user->ban_reason }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
