@if ($conversation)
    <li class="user-list__item {{ $conversation->id == $conversationId ? 'active' : '' }}">
        <a class="text-decoration-none" href="{{ route('user.message.index', encrypt($conversation->id)) }}">
            <div class="user-list__item-wrapper">
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
                        <h6 class="name mt-0">{{ __($opponent->fullname) }}</h6>
                        <p class="text mb-0">{{ __(strLimit(@$conversation->messages->first()->message, 40)) }}</p>
                    </div>
                </div>
                <div class="user-list__time-message">
                    <span class="time">{{ diffForHumans(@$conversation->messages->where('sender_id', '!=', $user->id)->first()->created_at) }}</span>
                </div>
            </div>
        </a>
    </li>
@endif

@foreach ($conversations as $item)
    @php
        if ($item->sender_id == $user->id) {
            $chatUser = $item->receiver;
        } else {
            $chatUser = $item->sender;
        }
    @endphp

    <li class="user-list__item">
        <a class="text-decoration-none" href="{{ route('user.message.index', encrypt($item->id)) }}">
            <div class="user-list__item-wrapper">
                <div class="user-list__nameThumb">
                    <div class="thumb">
                        <img src="{{ $chatUser->profilePicture() }}" alt="">

                        @if ($chatUser->online())
                            <span class="dot active"></span>
                        @else
                            <span class="dot"></span>
                        @endif
                    </div>
                    <div class="name-text">
                        <h6 class="name mt-0">{{ __($chatUser->fullname) }}</h6>
                        <p class="text mb-0">{{ __(strLimit(@$item->messages->first()->message, 40)) }}</p>
                    </div>
                </div>
                <div class="user-list__time-message">
                    <span class="time">{{ diffForHumans(@$item->messages->where('sender_id', '!=', $chatUser->id)->first()->created_at) }}</span>
                    @if ($item->messages_count)
                        <span class="message">{{ $item->messages_count }}</span>
                    @endif
                </div>
            </div>
        </a>
    </li>
@endforeach

@if (!count($conversations) && !$conversation)
    <li class="user-list__item text-center"><small class="text--base">@lang('There is no conversation available')</small></li>
@endif
