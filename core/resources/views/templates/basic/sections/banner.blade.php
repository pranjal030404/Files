@php
    $bannerContent = getContent('banner.content', true);
    $bannerElement = getContent('banner.element', limit: 5);

    $countryData = (array) json_decode(file_get_contents(resource_path('views/partials/country.json')));
    $countries = array_column($countryData, 'country');
    $maritalStatuses = App\Models\MaritalStatus::all();
@endphp

<!-- Hero  -->
<section class="hero">
    <div class="hero-slider">
        @foreach ($bannerElement as $banner)
            <div class="hero-slider__item">
                <img src="{{ frontendImage('banner', $banner->data_values->slider_image, '1920x1080') }}" alt="@lang('Banner')">
            </div>
        @endforeach
    </div>

    <div class="hero__content">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-xl-7 col-lg-6 pe-xl-5">
                    <h4 class="hero__content-subtitle text-dark mt-0">
                        <span>@lang('Welcome')</span> {{ __('To ' . gs('site_name')) }}
                    </h4>
                    <h1 class="hero__content-title text-capitalize">
                        {{ __(@$bannerContent->data_values->subheading) }}
                    </h1>
                    <div class="mx-auto">
                        <a class="btn btn--base mt-3" href="{{ url(@$bannerContent->data_values->button_url) }}">
                            {{ __(@$bannerContent->data_values->button_text) }}
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="banner-account">
                        <form class="register-form" action="{{ route('member.list') }}">
                            <div class="section__head pb-3 text-center">
                                <h2 class="login-title mt-0">@lang('Find Your Partner')</h2>
                            </div>
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="country">
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}">{{ __($country) }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Country')</label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="city" name="city" type="text">
                                        <label class="form--label" for="city">@lang('City')</label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="profession" name="profession" type="text">
                                        <label class="form--label" for="profession">@lang('Profession')</label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="marital_status">
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($maritalStatuses as $maritalStatus)
                                                <option value="{{ $maritalStatus->title }}">{{ __($maritalStatus->title) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form--label">@lang('Marital Status')</label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="looking_for">
                                            <option value="">@lang('Select One')</option>
                                            <option value="1">@lang('Bridegroom')</option>
                                            <option value="2">@lang('Bride')</option>
                                        </select>
                                        <label class="form--label">@lang('Looking For')</label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="smoking_status">
                                            <option value="">@lang('Select One')</option>
                                            <option value="1">@lang('Smoker')</option>
                                            <option value="0">@lang('Non-smoker')</option>
                                        </select>
                                        <label class="form--label">@lang('Smoking Habits')</label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="drinking_status">
                                            <option value="">@lang('Select One')</option>
                                            <option value="1">@lang('Drunker')</option>
                                            <option value="0">@lang('Non-drunker')</option>
                                        </select>
                                        <label class="form--label">@lang('Drinking Status')</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn--base w-100" type="submit">@lang('Search')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
