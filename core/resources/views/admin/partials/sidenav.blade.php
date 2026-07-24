@php
    $sideBarLinks = json_decode($sidenav);
@endphp

<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img src="{{siteLogo()}}" alt="image"></a>
        </div>
        <div class="sidebar__menu-wrapper">
            <ul class="sidebar__menu">
                @foreach($sideBarLinks as $key => $data)
                    @if (isset($data->header))
                        <li class="sidebar__menu-header">{{ __($data->header) }}</li>
                    @endif
                    @if(isset($data->submenu))
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" @isset($data->menu_active) class="{{ menuActive($data->menu_active, 3) }}" @endisset>
                                <i class="menu-icon {{ isset($data->icon) ? $data->icon : '' }}"></i>
                                <span class="menu-title">{{ isset($data->title) ? __($data->title) : '' }}</span>
                                @isset($data->counters)
                                    @foreach($data->counters ?? [] as $counter)
                                        @if($$counter > 0)
                                            <span class="menu-badge menu-badge-level-one bg--warning ms-auto">
                                                <i class="fas fa-exclamation"></i>
                                            </span>
                                            @break
                                        @endif
                                    @endforeach
                                @endisset
                            </a>
                            <div class="sidebar-submenu {{ isset($data->menu_active) ? menuActive($data->menu_active, 2) : '' }} ">
                                <ul>
                                    @foreach($data->submenu as $menu)
                                    @php
                                        $submenuParams = null;
                                        if (isset($menu->params)) {
                                            foreach ($menu->params as $submenuParamVal) {
                                                $submenuParams[] = array_values((array)$submenuParamVal)[0];
                                            }
                                        }
                                    @endphp
                                        <li class="sidebar-menu-item {{ isset($menu->menu_active) ?  menuActive($menu->menu_active, param:$submenuParams) : '' }} ">
                                            <a href="{{ isset($menu->route_name) ? route($menu->route_name,$submenuParams) : '' }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">{{ __($menu->title) }}</span>
                                                @php $counter = isset($menu->counter) ? $menu->counter : ''; @endphp
                                                @if(isset($$counter) && $$counter)
                                                    <span class="menu-badge bg--info ms-auto">{{ $$counter }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @else
                        @php
                            $mainParams = null;
                            if (isset($data->params)) {
                                foreach ($data->params as $paramVal) {
                                    $mainParams[] = array_values((array)$paramVal)[0];
                                }
                            }
                        @endphp
                        <li class="sidebar-menu-item {{ isset($data->menu_active) ? menuActive($data->menu_active, param:$mainParams) : '' }}">
                            <a href="{{ route($data->route_name,$mainParams) }}" class="nav-link">
                                <i class="menu-icon {{ $data->icon }}"></i>
                                <span class="menu-title">{{ isset($data->title) ? __($data->title) : '' }}</span>
                                @php $counter = isset($data->counter) ? $data->counter : ''; @endphp
                                @if(isset($$counter) && $$counter)
                                    <span class="menu-badge bg--info ms-auto">{{ $$counter }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="version-info text-center text-uppercase">
            <span class="text--primary">{{__(systemDetails()['name'])}}</span>
            <span class="text--success">@lang('V'){{systemDetails()['version']}} </span>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if($('li').hasClass('active')){
            $('.sidebar__menu-wrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            },500);
        }
    </script>
@endpush
