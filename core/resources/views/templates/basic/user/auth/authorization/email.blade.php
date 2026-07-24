@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-6">
                    <div class="d-flex justify-content-center">
                        <div class="verification-code-wrapper login__wrapper">
                            <div class="verification-area">
                                <div class="section__head pb-3 text-center">
                                    <h2 class="login-title mt-0">@lang('Verify Email Address')</h2>
                                    <p class="t-short-para mx-auto mb-0 text-center">
                                        @lang('A 6 digit verification code sent to your email address'):  {{ showEmailAddress(auth()->user()->email) }}
                                    </p>
                                </div>
                                <form class="submit-form" action="{{ route('user.verify.email') }}" method="POST">
                                    @csrf
                                    @include($activeTemplate . 'partials.verification_code')

                                    <button class="btn btn--base w-100 mt-3" type="submit">@lang('Submit')</button>

                                    <div class="input--group email-verify mt-3">
                                        @lang('If you don\'t get any code'), <span class="countdown-wrapper">@lang('try again after') <span id="countdown" class="fw-bold">--</span> @lang('seconds')</span> <a href="{{route('user.send.verify.code', 'email')}}" class="try-again-link d-none"> @lang('Try again')</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var distance =Number("{{ isset($user->ver_code_send_at) ? $user->ver_code_send_at->addMinutes(2)->timestamp - time() : '' }}");
        var x = setInterval(function() {
            distance--;
            document.getElementById("countdown").innerHTML = distance;
            if (distance <= 0) {
                clearInterval(x);
                document.querySelector('.countdown-wrapper').classList.add('d-none');
                document.querySelector('.try-again-link').classList.remove('d-none');
            }
        }, 1000);
    </script>
@endpush
