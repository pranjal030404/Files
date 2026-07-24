@extends( 'Template::layouts.frontend')
@section('content')
    @php
        $contactContent = getContent('contact_us.content', true);
    @endphp
    <div class="section--sm section--top bg--light">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card__icon-container text-center">
                            <div class="contact-card__icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                        <div class="contact-card__body">
                            <h5 class="mt-md-0">{{ __(@$contactContent->data_values->office_address_title) }}</h5>
                            <p>{{ __(@$contactContent->data_values->office) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card__icon-container text-center">
                            <div class="contact-card__icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="contact-card__body">
                            <h5 class="mt-md-0">{{ __(@$contactContent->data_values->email_address_title) }}</h5>
                            <a href="mailto:{{ @$contactContent->data_values->email }}">{{ __(@$contactContent->data_values->email) }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card__icon-container text-center">
                            <div class="contact-card__icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </div>
                        <div class="contact-card__body">
                            <h5 class="mt-md-0">{{ __(@$contactContent->data_values->contact_number_title) }}</h5>
                            <a href="tel:{{ @$contactContent->data_values->contact_number }}">{{ __(@$contactContent->data_values->contact_number) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section--sm section--bottom bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3 class="form-title mt-0">{{ @$contactContent->data_values->title }}</h3>
                            </div>
                            <form class="verify-gcaptcha" action="" autocomplete="off" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 @auth d-none @endauth mt-4">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="name" name="name" type="text" value="{{ auth()->user() ? auth()->user()->fullname : old('name') }}" @if (auth()->user()) readonly @endif required placeholder=" ">
                                            <label class="form--label" for="name">@lang('Name')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 @auth d-none @endauth mt-4">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="email" name="email" type="email" value="{{ auth()->user() ? auth()->user()->email : old('email') }}" @if (auth()->user()) readonly @endif required>
                                            <label class="form--label" for="email">@lang('Email Address')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="subject" name="subject" type="text" value="{{ old('subject') }}" required>
                                            <label class="form--label" for="subject">@lang('Subject')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <div class="input--group">
                                            <textarea class="form-control form--control" id="message" name="message" required>{{ old('message') }}</textarea>
                                            <label class="form--label" for="message">@lang('Message')</label>
                                        </div>
                                    </div>

                                    <x-captcha :path="$activeTemplate . 'partials.'" />

                                    <div class="col-sm-12">
                                        <button class="btn btn--base w-100 mt-3" type="submit">{{ __(@$contactContent->data_values->button_text) }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-img">
                        <img class="contact-img__is" src="{{ frontendImage('contact_us', @$contactContent->data_values->image, '800x550') }}" alt="@lang('Contact Us')" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($sections != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include(activeTemplate() . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
