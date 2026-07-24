@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card custom--card">
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="row gy-4">
                            <div class="input--group col-12">
                                <input type="password" class="form-control form--control" name="current_password" required
                                       autocomplete="current-password">
                                <label class="form--label required">@lang('Current Password')</label>
                            </div>

                            <div class="input--group col-12">
                                <input type="password"
                                       class="form-control form--control @if (gs('secure_password')) secure-password @endif"
                                       name="password" required autocomplete="current-password">
                                <label class="form--label required">@lang('Password')</label>
                            </div>
                            <div class="input--group col-12">
                                <input type="password" class="form-control form--control" name="password_confirmation"
                                       required autocomplete="current-password">
                                <label class="form--label">@lang('Confirm Password')</label>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
