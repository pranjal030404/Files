@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="login section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="login__wrapper">
                        <form class="info-form" action="{{ route('user.data.submit', 'familyInfo') }}" autocomplete="off" method="POST">
                            @csrf
                            <div class="section__head text-center">
                                <h2 class="login-title mt-0">{{ __($pageTitle) }}</h2>
                            </div>
                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="father_name" type="text" value="{{ old('father_name') }}" required>
                                        <label class="form--label">@lang('Father\'s Name')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="father_profession" type="text" value="{{ old('father_profession') }}">
                                        <label class="form--label">@lang('Father\'s Profession')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="father_contact" type="number" value="{{ old('father_contact') }}" min="0" required>
                                        <label class="form--label">@lang('Fahter\'s Contact')</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="mother_name" type="text" value="{{ old('mother_name') }}" required>
                                        <label class="form--label">@lang('Mother\'s Name')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="mother_profession" type="text" value="{{ old('mother_profession') }}">
                                        <label class="form--label">@lang('Mother\'s Profession')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="mother_contact" type="number" value="{{ old('mother_contact') }}" min="0" required>
                                        <label class="form--label">@lang('Mother\'s Contact')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="total_brother" type="number" value="{{ old('total_brother') }}" min="0">
                                        <label class="form--label">@lang('Total Brother')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" name="total_sister" type="number" value="{{ old('total_sister') }}" min="0">
                                        <label class="form--label">@lang('Total Sister')</label>
                                    </div>
                                </div>
                                <div class="append-form d-none"></div>
                                <div class="d-flex justify-content-end flex-wrap gap-2">
                                    <button class="btn btn-sm btn--dark back-btn" type="button"><i class="las la-arrow-left"></i>@lang('Back')</button>
                                    <button class="btn btn-sm btn--warning skip-btn" type="button"><i class="las la-forward"></i> @lang('Skip')</button>
                                    <button class="btn btn-sm btn-success" name="button_value" type="submit" value="submit">@lang('Next') <i class="las la-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.skip-btn').on('click', function() {
            $('.info-form').submit();
        })

        $('.back-btn').on('click', function() {
            $('.append-form').append(`<input type="hidden" name="back_to" value="basicInfo">`);
            $('.info-form').submit();
        })
    </script>
@endpush
