@php
    use App\Constants\Status;
    $footerContent = getContent('footer.content', true);
    $contactContent = getContent('contact_us.content', true);
    $policyPageElement = getContent('policy_pages.element', false, null, true);
    $pages = App\Models\Page::where('tempname', activeTemplate())
        ->where('is_default', Status::NO)
        ->get();
@endphp
<!-- Footer  -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__content section">
                    <div class="row g-4 justify-content-xl-between">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer__contact">
                                <h4 class="footer__title text--white mt-0">
                                    {{ __(@$footerContent->data_values->title) }}</h4>
                                <p class="text--white">
                                    {{ __(@$footerContent->data_values->description) }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 col-xl-2">
                            <h4 class="footer__title text--white mt-0">@lang('Quick Links')</h4>
                            <ul class="footer__contact list list--base list--column">
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="{{ route('home') }}"> @lang('Home')</a>
                                </li>
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="{{ route('stories') }}">
                                        @lang('Stories')</a>
                                </li>
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="{{ route('blog') }}">
                                        @lang('Blog')</a>
                                </li>
                                @foreach ($pages as $page)
                                    <li class="nav-item">
                                        <a class="t-link t-link--base text--white d-inline-block" href="{{ url($page->slug) }}">{{ __($page->name) }}</a>
                                    </li>
                                @endforeach
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="{{ route('contact') }}">
                                        @lang('Contact')</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 col-lg-3 col-xl-2">
                            <h4 class="footer__title text--white mt-0">@lang('Policies')</h4>
                            <ul class="footer__contact list list--base list--column">
                                @foreach ($policyPageElement as $policy)
                                    <li class="nav-item">
                                        <a class="t-link t-link--base text--white d-inline-block" href="{{ route('policy.pages', [slug($policy->data_values->title)]) }}">{{ __($policy->data_values->title) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <h4 class="footer__title text--white mt-0">@lang('Contact Us')</h4>
                            <ul class="footer__contact list list--column mt-4">
                                <li><i class="fas fa-phone-alt"></i> <a class="t-link t-link--base text--white d-inline-block" href="tel: {{ @$contactContent->data_values->contact_number }}">{{ @$contactContent->data_values->contact_number }}</a>
                                </li>
                                <li><i class="far fa-envelope"></i> <a class="t-link t-link--base text--white d-inline-block" href="mailto: {{ @$contactContent->data_values->email }}">{{ @$contactContent->data_values->email }}</a>
                                </li>
                                <li class="address"><i class="fas fa-map-marker-alt"></i>{{ @$contactContent->data_values->office }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__copyright">
                    <p class="sm-text text--white mb-0 text-center">
                        @lang('Copyright') &copy; {{ date('Y') }}. @lang('All Rights Reserved By')
                        <a class="t-link t-link--base text--base" href="{{ route('home') }}">{{ gs('site_name') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
