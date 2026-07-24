@php
    $requiredConfig = new \App\Lib\RequiredConfig();
    $configs = $requiredConfig->getConfig();
    $progressPercentage = $requiredConfig->completedConfigPercent();
    $completedConfig = $requiredConfig->completedConfig();
    uksort($configs, function ($a, $b) use ($completedConfig) {
        $aIndex = array_search($a, $completedConfig);
        $bIndex = array_search($b, $completedConfig);
        $aIndex = $aIndex === false ? -1 : $aIndex + 100;
        $bIndex = $bIndex === false ? -1 : $bIndex + 100;

        return $aIndex <=> $bIndex;
    });
@endphp
@if ($requiredConfig->completedConfigCount() < $requiredConfig->totalConfigs())

    <div class="configure-card-wrapper">
        <div class="configure-card">
            <div class="configure-card-header">
                <div class="configure-card-top flex-align gap-4">
                    <div class="configure-card-left flex-1">
                        <div class="configure-card-slide">
                            @foreach ($configs as $key => $config)
                                <h6 class="configure-card-title flex-align gap-2 mb-2 flex-nowrap"
                                    data-config_url="{{ $config['route'] }}">
                                    <span class="configure-status @if (in_array($key, $completedConfig)) complete @endif"><i
                                            class="fas fa-check"></i></span>
                                    {{ __($config['title']) }}
                                </h6>
                            @endforeach
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ $progressPercentage }}%"></div>
                        </div>
                    </div>
                    <a href="" class="configure-card-link flex-shrink-0 d-inline-flex gap-1 align-items-center">
                        <i class="fas fa-cog"></i>
                        <span class="d-none d-sm-block">@lang('Configure')</span>
                    </a>
                </div>
                <div class="configure-card-bottom flex-align mt-2">
                    <a href="javascript:void(0)" class="next-btn">
                        <i class="fa-solid fa-arrow-left"></i>
                        @lang('Previous')
                    </a>
                    <div class="flex-1 flex-center gap-2">
                        <span class="count">
                            <span class="configure-count">{{ $requiredConfig->completedConfigCount() }}</span>
                            @lang('of') <span class="configure-total">{{ $requiredConfig->totalConfigs() }}</span>
                        </span>
                        <div class="show-btn">
                            @lang('Show')
                            <span class="icon text-white">
                                <i class="las la-angle-down"></i>
                            </span>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="prev-btn">
                        @lang('Next')
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="configure-card-body">
                <ul class="configure-list">
                    @foreach ($configs as $key => $config)
                        <li class="configure-item flex-between">
                            <div class="configure-item-name d-flex align-items-center gap-2 flex-grow-1">
                                <span class="configure-status @if (in_array($key, $completedConfig)) complete @endif"><i
                                        class="fas fa-check text-white"></i></span>
                                <div class="d-flex justify-content-between align-items-center flex-grow-1">
                                    <span>{{ __($config['title']) }}</span>
                                    <a href="{{ $config['route'] }}" class="configure-item-btn flex-shrink-0 @if (in_array($key, $completedConfig)) disabled @endif">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="d-none d-sm-block">@lang('Configure Now')</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="configure-card-btn configure-card-handle">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-settings-icon lucide-settings">
                <path
                    d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
        </div>
    </div>


@push('script-lib')
    <script src="{{ asset('assets/admin/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.ui.touch-punch.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            const configureCardWrapperStyle = localStorage.getItem('configure-card-wrapper-style');

            if (configureCardWrapperStyle) {
                $('.configure-card-wrapper').attr('style',configureCardWrapperStyle);
            }



            let isDragging = false;
            let listShowed = false;
            const windowWidth = $(window).width();
            let elementHeight = $('.configure-card-body').outerHeight(true) + $('.configure-card-header').outerHeight(true) + 2;
            if (windowWidth <= 575) {
                elementHeight += 6;
            }
            let spaceFromRight = 20;
            let spaceFromTop = 20;
            let spaceFromBottom = 20;
            let configBtnHeight = 64;
            $('.configure-card-wrapper').draggable({
                handle: '.configure-card-handle',
                cancel: '.configure-card-body',
                start: function(event, ui) {
                    isDragging = true;
                    ui.helper.css({
                        "bottom": "auto",
                        'transition': 'unset'
                    });
                },
                drag: function(event, ui) {
                    if (listShowed) {
                        return false;
                    }
                    const $el = ui.helper;
                    const elHeight = $el.outerHeight();
                    const windowHeight = $(window).height();
                    const draggedBottom = windowHeight - (ui.position.top + elHeight);
                    if (draggedBottom < spaceFromBottom) {
                        ui.position.top = windowHeight - elHeight - spaceFromBottom;
                    }
                    const topLimit = 10;
                    if (ui.position.top < topLimit) {
                        ui.position.top = topLimit;
                    }
                    return true;
                },
                stop: function(event, ui) {
                    setTimeout(() => isDragging = false, 100);
                    if (listShowed) {
                        return;
                    }
                    const $el = ui.helper;
                    const elWidth = $el.outerWidth();
                    const targetLeft = windowWidth - elWidth - spaceFromRight;
                    const settingBtn = $('.configure-card-btn').offset();
                    const bottomValue = ($(window).height() - (settingBtn.top - $(window).scrollTop())) - configBtnHeight;
                    let bottomValueCss = `${bottomValue < spaceFromBottom ? spaceFromBottom : bottomValue}px`;
                    let topCss = 'auto';
                    $('.configure-card-body').css({
                        "height": 'auto',
                    });
                    if (bottomValue > ($(window).height() - spaceFromTop - spaceFromBottom) * 0.4) { // if 40% of window height cross
                        bottomValueCss = 'auto';
                        topCss = settingBtn.top - $(window).scrollTop();
                        $el.css({
                            'align-items': 'flex-start',
                        })
                        if (windowWidth <= 991) {
                            topCss = settingBtn.top - $(window).scrollTop();
                        }
                        if (windowWidth <= 575) {
                            topCss = ((settingBtn.top - $(window).scrollTop()) + configBtnHeight) - $('.configure-card-wrapper').height();
                            $el.css({
                                'flex-direction': 'column-reverse',
                                'align-items': 'flex-end',
                            })
                        }
                        if (topCss < 10) {
                            topCss = 10;
                        }
                        topCss = `${topCss}px`;
                        if (bottomValue < 400 + 20 + 20) {
                            $('.configure-card-body').css({
                                "height": bottomValue - 20,
                            });
                        }
                        $('.configure-card').css({
                            'transform-origin': 'top right',
                        })
                    } else {
                        setConfigListHeight(bottomValue, settingBtn);
                        $el.css({
                            'align-items': 'flex-end',
                        })
                        $('.configure-card').css({
                            'transform-origin': 'bottom right',
                        })
                        if (windowWidth <= 575) {
                            $el.css({
                                'flex-direction': 'column',
                            })
                        }
                    }
                    $el.css({
                        "bottom": bottomValueCss,
                        "top": topCss,
                        "transition": "all linear .3s",
                        "left": "auto"
                    });

                    const style = $('.configure-card-wrapper').attr('style');
                    localStorage.setItem('configure-card-wrapper-style', style);

                },
            });
            const setConfigListHeight = (bottomValue, settingBtn) => {
                let topSpace = 20;
                if ((elementHeight + configBtnHeight + bottomValue + topSpace) > $(window)
                    .height()) {
                    let fromTop = settingBtn.top + configBtnHeight;
                    if (windowWidth <= 575) {
                        fromTop -= configBtnHeight;
                    }
                    const topValue = (fromTop - topSpace - $('.configure-card-header').outerHeight(true));
                    $('.configure-card-body').css({
                        "height": topValue,
                    });
                }
            }
            const configSettingBtn = $('.configure-card-btn').offset();
            const fromBottomSpace = ($(window).height() - (configSettingBtn.top - $(window).scrollTop())) - configBtnHeight;
            setConfigListHeight(fromBottomSpace, configSettingBtn);
            $('.configure-card-btn').on('click', function(e) {
                if (isDragging) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                const toggleConfigureCard = () => {
                    $('.configure-card').toggleClass('show')
                    if ($('.configure-card').hasClass('show')) {
                        $('.configure-card').removeClass('hide')
                    } else {
                        $('.configure-card').addClass('hide')
                    }
                }
                if (listShowed) {
                    $('.show-btn').trigger('click');
                    setTimeout(() => {
                        toggleConfigureCard();
                    }, 500)
                } else {
                    toggleConfigureCard();
                }
            })
            $('.show-btn').on('click', function() {
                listShowed = listShowed ? false : true;
                $('.configure-card-body').slideToggle('')
                $(this).toggleClass('active');
            })
        })(jQuery);
    </script>
@endpush

@endif
