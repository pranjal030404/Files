@php
    use App\Constants\Status;
    use App\Models\Language;
    $pages = App\Models\Page::where('tempname', activeTemplate())
        ->where('is_default', Status::NO)
        ->get();
@endphp

<!-- ==================== Bottom Header End Here ==================== -->
<header class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}">
                <img src="{{ siteLogo('dark') }}" alt="site logo">
            </a>
            <button class="navbar-toggler header-button" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="las la-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('home') }}" href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('packages') }}" href="{{ route('packages') }}">@lang('Packages')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('member.list') }}" href="{{ route('member.list') }}">@lang('Members')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('stories') }}" href="{{ route('stories') }}">@lang('Stories')</a>
                    </li>

                    @foreach ($pages as $page)
                        <li class="nav-item">
                            <a class="nav-link @if (request()->url() == route('pages', [$page->slug])) active @endif" href="{{ url($page->slug) }}">{{ __($page->name) }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('contact') }}" href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>

                    @auth
                        <li class="nav-item d-lg-none d-block">
                            <a class="nav-link {{ menuActive('user.home') }}" href="{{ route('user.login') }}">
                                @lang('Dashboard')</a>
                        </li>
                        <li class="nav-item d-lg-none d-block d-flex justify-content-between">
                            <a class="nav-link" href="{{ route('user.logout') }}"> @lang('Logout')</a>
                            @if (gs('multi_language'))
                                <select class="langSel select language-select">
                                    @php
                                        $language = Language::all();
                                    @endphp
                                    @foreach ($language as $lang)
                                        <option value="{{ $lang->code }}" @selected(session()->get('lang') == $lang->code)>@lang($lang->name)
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </li>
                    @else
                        <li class="nav-item d-lg-none d-block">
                            <a class="nav-link {{ menuActive('user.login') }}" href="{{ route('user.login') }}">
                                @lang('Login')</a>
                        </li>
                        <li class="nav-item d-lg-none d-block d-flex justify-content-between">
                            <a class="nav-link {{ menuActive('user.register') }}" href="{{ route('user.register') }}">
                                @lang('Register') </a>
                            @if (gs('multi_language'))
                                <select class="langSel select language-select">
                                    @php
                                        $language = Language::all();
                                    @endphp
                                    @foreach ($language as $lang)
                                        <option value="{{ $lang->code }}" @selected(session()->get('lang') == $lang->code)>@lang($lang->name)
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </li>

                    @endauth
                </ul>
                <div class="d-none d-lg-block">
                    <ul class="header-login list primary-menu">
                        @include('Template::partials.language')
                        @auth
                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm" href="{{ route('user.home') }}"> <i class="las la-user"></i> @lang('Dashboard')</a>
                            </li>

                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm btn--outline" href="{{ route('user.logout') }}">
                                    @lang('Logout') </a>
                            </li>
                        @else
                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm" href="{{ route('user.login') }}"> <i class="las la-user"></i> @lang('Login')</a>
                            </li>

                            @if (gs('registration'))
                                <li class="header-login__item">
                                    <a class="btn btn--base btn--sm btn--outline" href="{{ route('user.register') }}">
                                        @lang('Register') </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <!-- User Login End -->
            </div>
        </nav>
    </div>
</header>
<!-- ==================== Bottom Header End Here ==================== -->

<!-- =========================== Mobile Device Bottom Navigation Start ============================ -->
<div class="mobile-nav d-lg-none d-block">
    <div class="container">
        <ul class="mobile-nav__menu d-flex justify-content-between">
            <li class="mobile-nav__item">
                <a class="mobile-nav__link text-decoration-none" href="{{ route('home') }}">
                    <i class="las la-home"></i>
                    <span>@lang('Home')</span>
                </a>
            </li>

            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="{{ route('member.list') }}">
                    <i class="las la-users"></i>
                    <span>@lang('Members')</span>
                </a>
            </li>

            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="{{ route('contact') }}">
                    <i class="las la-comment-dots"></i>
                    <span>@lang('Contact')</span>
                </a>
            </li>
            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="{{ route('user.login') }}">
                    <span>
                        @auth
                            <i class="las la-tachometer-alt"></i>
                            @lang('Dashboard')
                        @else
                            <i class="las la-user"></i>
                            @lang('Account')
                        @endauth
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            const $mainlangList = $(".langList");
            const $langBtn = $(".language-content");
            const $langListItem = $mainlangList.children();

            $langListItem.each(function() {
                const $innerItem = $(this);
                const $languageText = $innerItem.find(".language_text");
                const $languageFlag = $innerItem.find(".language_flag");

                $innerItem.on("click", function(e) {
                    $langBtn.find(".language_text_select").text($languageText.text());
                    $langBtn.find(".language_flag").html($languageFlag.html());
                });
            });
        });
    </script>
@endpush
