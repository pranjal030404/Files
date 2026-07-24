@php
    use App\Constants\Status;$pages = App\Models\Page::where('tempname', activeTemplate())
        ->where('is_default', Status::NO)
        ->get();
    $language = \App\Models\Language::all();
@endphp
    <!-- Header -->

<!-- ==================== Bottom Header End Here ==================== -->
<header class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}"><img
                    src="{{ siteLogo('dark') }}" alt="Site Logo"></a>
            <button class="navbar-toggler header-button" data-bs-target="#navbarSupportedContent"
                    data-bs-toggle="collapse" type="button" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="las la-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('home') }}" href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('packages') }}"
                           href="{{ route('packages') }}">@lang('Packages')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('member.list') }}"
                           href="{{ route('member.list') }}">@lang('Members')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('stories') }}"
                           href="{{ route('stories') }}">@lang('Stories')</a>
                    </li>

                    @foreach ($pages as $page)
                        <li class="nav-item">
                            <a class="nav-link @if (request()->url() == route('pages', [$page->slug])) active @endif"
                               href="{{ url($page->slug) }}">{{ __($page->name) }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('contact') }}"
                           href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                    <li class="nav-item d-lg-none d-block">
                        <a class="nav-link {{ menuActive('user.home') }}" href="{{ route('user.login') }}">
                            @lang('Dashboard')</a>
                    </li>
                    <li class="nav-item d-lg-none d-block d-flex justify-content-between">
                        <a class="nav-link" href="{{ route('user.logout') }}"> @lang('Logout')</a>

                        @include('Template::partials.language')

                    </li>
                </ul>
                <div class="d-none d-lg-block">
                    <ul class="header-login list primary-menu">

                       @include('Template::partials.language')

                        <li class="header-login__item">
                            <a class="btn btn--base btn--sm" href="{{ route('user.home') }}"> <i
                                    class="las la-user"></i> @lang('Dashboard')</a>
                        </li>

                        <li class="header-login__item">
                            <a class="btn btn--base btn--sm btn--outline"
                               href="{{ route('user.logout') }}"> @lang('Logout') </a>
                        </li>
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
                <a class="mobile-nav__link text-decoration-none" href="{{ route('user.home') }}">
                    <i class="las la-home"></i>
                    <span>@lang('Dashboard')</span>
                </a>
            </li>

            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="{{ route('member.list') }}">
                    <i class="las la-users"></i>
                    <span>@lang('Members')</span>
                </a>
            </li>

            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="{{ route('user.interest.requests') }}">
                    <i class="la la-heart-o"></i>
                    <span>@lang('Interest Request')</span>
                </a>
            </li>

            <li class="mobile-nav__item dashboard-sidebar-show">
                <a class="mobile-nav__link" href="javascript:void(0)">
                    <i class="las la-bars"></i>
                    <span>@lang('Menu')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
