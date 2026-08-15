@extends('Template::layouts.frontend')
@section('content')
    <div class="section bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="chatbox">
                        <div class="chatbox__container">
                            <div class="row g-0">
                                <div class="col-lg-4 col-md-5">
                                    <div class="chatbox-left">
                                        <div class="chatbox-left__searchbox">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="chatbox-left__title mt-0 text-center mb-0">
                                                    @lang('Members List')
                                                </h6>
                                                <div class="chatbox-left__close text-dark fs-5 d-md-none d-block">
                                                    <i class="las la-times"></i>
                                                </div>
                                            </div>

                                            <div class="input-group mt-2">
                                                <input class="form-control form--control" id="search-box" name="search"
                                                    data-has_value="0" type="text">
                                                <label class="form--label" for="search-box">@lang('Search Member')</label>
                                                <button class="input-group-text btn--base border-0"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="chatbox-left__users memberListWrapper">
                                            <ul class="user-list memberList">
                                                @include($activeTemplate . 'user.message.member_list')
                                            </ul>

                                        </div>
                                        <div class="chatbox-left__dashboardBtn">
                                            <a class="btn btn--base w-100 rounded-0"
                                                href="{{ route('user.home') }}">@lang('Go to Dashboard')</a>
                                        </div>

                                        <div class="user-list__preloader-bottom d-none append-loader">
                                            <div class="spinner-border text-secondary" role="status">
                                                <span class="visually-hidden"></span>
                                            </div>
                                        </div>
                                        <div class="user-list__preloader-center search-loader d-none">
                                            <div class="spinner-border text-secondary" role="status">
                                                <span class="visually-hidden"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-12">
                                    @if ($conversationId)
                                        <div class="chatbox-right">
                                            <div class="chatbox-header">
                                                <div class="user-list__nameThumb">
                                                    <div class="thumb">
                                                        <img src="{{ $opponent->profilePicture() }}" alt="">

                                                        @if ($opponent->online())
                                                            <span class="dot active"></span>
                                                        @else
                                                            <span class="dot"></span>
                                                        @endif

                                                    </div>
                                                    <div class="name-text">
                                                        <h6 class="name mt-0 mb-0">
                                                            {{ __($opponent->firstname ? $opponent->fullname : $opponent->username) }}
                                                        </h6>
                                                        <p class="text mb-0"> {{ __(@$opponent->basicInfo->profession) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-sm-2 flex-wrap gap-1">
                                                    <div class="chatbox-refresh">
                                                        <button class="chatbox-refresh__icon refreshMessage"
                                                            type="button"><i class="las la-redo-alt"></i></button>
                                                    </div>
                                                    <div
                                                        class="chatbox-header__icons d-flex align-items-center gap-sm-2 gap-1">
                                                        <span class="chatbox-header__icon-chatbox-left d-md-none"><i
                                                                class="las la-users"></i></span>
                                                        <span class="chatbox-header__icon-profile"><i
                                                                class="lar la-user"></i></span>
                                                    </div>
                                                </div>
                                                <div class="spinner-border text-secondary chatbox-loader d-none"
                                                    role="status">
                                                    <span class="visually-hidden"></span>
                                                </div>
                                            </div>
                                            <div class="chatbox-header__overlay"></div>
                                            <div class="chatbox-header__profile text-center">
                                                <div class="chatbox-header__thumb">
                                                    <img src="{{ $opponent->profilePicture() }}" alt="">
                                                </div>
                                                <h5 class="chatbox-header__name mb-2 mt-3">
                                                    {{ __($opponent->firstname ? $opponent->fullname : $opponent->username) }}
                                                </h5>
                                                <ul class="chatbox-header__list d-flex flex-column justify-content-center">
                                                    <div class="row text-start">
                                                        <div class="col-6 chatbox-header__item">@lang('Age'):</div>
                                                        <div class="col-6 chatbox-header__item">
                                                            {{ $opponent->age() }}
                                                        </div>
                                                    </div>
                                                    <div class="row text-start">
                                                        <div class="col-6 chatbox-header__item">@lang('Height'):</div>
                                                        <div class="col-6">
                                                            {{ @$opponent->physicalAttributes->height ? __(@$opponent->physicalAttributes->height) . ' Ft.' : 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div class="row text-start">
                                                        <div class="col-6 chatbox-header__item">@lang('Religion'):</div>
                                                        <div class="col-6 chatbox-header__item">
                                                            {{ __(@$opponent->basicInfo->religion ?? 'N/A') }}
                                                        </div>
                                                    </div>
                                                    <div class="row text-start">
                                                        <div class="col-6 chatbox-header__item">@lang('Caste'):</div>
                                                        <div class="col-6 chatbox-header__item">
                                                            {{ __(@$opponent->basicInfo->caste ?? 'N/A') }}
                                                        </div>
                                                    </div>
                                                    <div class="row text-start">
                                                        <div class="col-6 chatbox-header__item">@lang('City'):</div>
                                                        <div class="col-6 chatbox-header__item">
                                                            {{ __(@$opponent->basicInfo->present_address->city) }}
                                                        </div>
                                                    </div>
                                                    <div class="row text-start">
                                                        <div class="col-6 chatbox-header__item">@lang('Country'):</div>
                                                        <div class="col-6 chatbox-header__item">
                                                            {{ __(@$opponent->basicInfo->present_address->country) }}
                                                        </div>
                                                    </div>
                                                </ul>
                                                <a class="btn btn--light-bg sm-text fw-md w-100 mt-3"
                                                    href="{{ route('user.member.profile.public', $opponent->id) }}">@lang('View Profile')</a>
                                            </div>

                                            <!-- Header Toggle Profile End -->

                                            <!-- Body Start  -->
                                            <div class="chatbox-body messageArea">

                                                @include($activeTemplate . 'user.message.get_message')
                                            </div>
                                            <!-- Footer Start -->
                                            <div
                                                class="chatbox-footer d-flex align-items-center justify-content-between gap-3">
                                                <div class="chatbox-footer__input">
                                                    <form class="chatForm" action="#" autocomplete="off"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="receiver_id" type="hidden"
                                                            value="{{ $opponent->id }}">
                                                        <input name="conversation_id" type="hidden"
                                                            value="{{ $conversationId }}">

                                                        <div class="input--group">
                                                            <input class="form-control form--control" name="message"
                                                                type="text" placeholder="@lang('Type Your Message')" id="message">
                                                            <label class="form--label"
                                                                for="message">@lang('Type Your Message')</label>
                                                            <ul
                                                                class="chatbox-comment-box d-flex align-items-center gap-3">
                                                                @if (gs('chat_attachment'))
                                                                    <li>
                                                                        <input id="image" name="image"
                                                                            type="file" hidden>
                                                                        <label class="image-label" for="image"><i
                                                                                class="las la-paperclip pointer"></i></label>
                                                                        <span class="fileName"></span>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <button class="submit-button" type="submit"><i
                                                                            class="far fa-paper-plane"></i></button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Footer End -->
                                        </div>
                                    @else
                                        <div class="chatbox-right">

                                            <!-- Body Start  -->
                                            <div class="chatbox-body messageArea">
                                                <div class="chatbox-body__list">
                                                    <div class="empty-body">
                                                        <span class="empty-body__icon"> <i
                                                                class="las la-frown"></i></span>
                                                        <span
                                                            class="empty-body__text">{{ __('Select a Member to view chats') }}</span>
                                                        <span
                                                            class="chatbox-header__icon-chatbox-left d-md-none mx-auto mt-2"><i
                                                                class="las la-users"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Body End -->
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input name="lastConversationId" type="hidden"
        value="{{ count($conversations) ? $conversations->last()->id : 0 }}">
    @if ($messages == null)
        <div class="conversationIndex d-none" data-conversation_id="{{ $conversationId }}" data-last_id="0"></div>

        <a class="hiddenClicker d-none" href="#message0"></a>
    @else
        @if (count($messages) > 0)
            <div class="conversationIndex d-none" data-conversation_id="{{ $conversationId }}"
                data-last_id="{{ $messages->first()->id }}"></div>

            <a class="hiddenClicker d-none" href="#message{{ $messages->last()->id }}"></a>
        @else
            <div class="conversationIndex d-none" data-conversation_id="{{ $conversationId }}" data-last_id="0"></div>

            <a class="hiddenClicker d-none" href="#message0"></a>
        @endif
    @endif
    <!-- chatbox End -->
@endsection

@push('script')
    <script>
        "use strict";

        bottom();
        $('[name=image]').on('change', function(e) {
            var fileName = e.target.files[0].name;
            console.log(fileName);
            $(".fileName").html(fileName);
        });

        $('.chatForm').on('submit', function(e) {
            e.preventDefault();
            var image = $('[name=image]').val();
            var message = $('[name=message]').val();
            var containerDiv = $(document).find('.conversationIndex');

            if (!image && !message) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('user.message.store') }}',
                data: new FormData(this),
                contentType: false,
                processData: false,

                success: function(response) {
                    if (response.success) {
                        containerDiv.data('last_id', response.lastId);
                        $('.messageArea').html(response.response);
                        $('[name=message]').val('');
                        $('[name=image]').val('');
                        $('.fileName').text('');

                        bottom();

                        notify('success', response.message);

                        scrollBottom();

                    } else {
                        $.each(response.error, function(key, value) {
                            notify('error', value);
                        });
                    }
                }
            });

        });


        $('.messageArea').scroll(function() {
            if ($(this).scrollTop() == 0) {
                var containerDiv = $(document).find('.conversationIndex');
                var lastId = containerDiv.data('last_id');
                var conversationId = containerDiv.data('conversation_id');

                if (lastId == 0) {
                    return;
                }

                $.ajax({
                    method: "get",
                    url: "{{ route('user.message.load') }}",
                    data: {
                        lastId: lastId,
                        conversationId: conversationId
                    },
                    beforeSend: function() {
                        $('.chatbox-loader').removeClass('d-none');
                    },
                    success: function(response) {

                        $('.messageArea').prepend(response.html);
                        containerDiv.data('last_id', response.lastId);
                    },
                    complete: function() {
                        $('.chatbox-loader').addClass('d-none');
                    }
                });
            }
        });

        function bottom() {
            document.querySelector('.messageArea').scrollTop = document.querySelector('.messageArea').scrollHeight;
        }

        function scrollBottom() {
            for (var i = 1; i <= 10; i++) {
                setTimeout(function() {
                    bottom();
                }, 100);
            }
        }

        //search member
        function searchMember(search) {
            let searchInput = $('[name=search]');
            let memberDiv = $('.memberList');

            if (search) {
                searchInput.data('has_value', 1);
            }

            let hasValue = searchInput.data('has_value');
            if (!hasValue) {
                return false;
            }

            $.ajax({
                type: "get",
                url: "{{ route('user.message.member.list') }}",
                data: {
                    search: search,
                    conversationId: "{{ $conversationId }}"
                },
                beforeSend: function() {
                    $('.search-loader').removeClass('d-none');
                },
                success: function(response) {
                    if (response.html != null) {
                        memberDiv.html(response.html);
                    }
                },
                complete: function() {
                    $('.search-loader').addClass('d-none');
                }
            });

            if (!search) {
                searchInput.data('has_value', 0);
            }
        }

        $("#search-box").on('focusout', function() {
            let search = $(this).val();
            searchMember(search);
        });


        $('#search-box').on('keypress', function(e) {
            if (e.keyCode == 13) {
                let search = $(this).val();
                searchMember(search);
            }
        })

        //member list scroll
        $('.memberListWrapper').scroll(function() {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 1) {
                let lastConversationId = $('[name=lastConversationId]').val();
                if (lastConversationId == 0) {
                    return;
                }

                $.ajax({
                    type: "get",
                    url: "{{ route('user.message.member.append') }}",
                    data: {
                        lastConversationId: lastConversationId,
                        conversationId: "{{ $conversationId }}"
                    },
                    beforeSend: function() {
                        $('.append-loader').removeClass('d-none');
                    },
                    success: function(response) {
                        let memberList = $('.memberList');
                        if (response.html != null) {
                            memberList.append(response.html);
                        }
                        $('[name=lastConversationId]').val(response.lastId);
                    },
                    complete: function() {
                        $('.append-loader').addClass('d-none');
                    }
                });
            }
        });

        $('.refreshMessage').on('click', function() {
            var containerDiv = $(document).find('.conversationIndex');
            $.ajax({
                method: "get",
                url: "{{ route('user.message.load') }}",
                data: {
                    lastId: 0,
                    conversationId: "{{ $conversationId }}"
                },
                beforeSend: function() {
                    $('.chatbox-loader').removeClass('d-none');
                },
                success: function(response) {
                    $('.messageArea').html(response.html);
                    containerDiv.data('last_id', response.lastId);
                },
                complete: function() {
                    $('.chatbox-loader').addClass('d-none');
                    scrollBottom();
                }
            });
        })


        $(document).mouseup(function(e) {
            let container = $(".chatbox-left");

            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.removeClass("show-chatbox-left");
                $(".toggle-overlay").removeClass("show-overlay");
            }
        });
    </script>
@endpush
