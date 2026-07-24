<div class="chatbox-body__list">
    @foreach ($messages as $message)
        @php
            $sender = $user;
            if ($message->sender_id == $opponent->id) {
                $sender = $opponent;
            }
        @endphp
        <div class="chatbox-body__item @if ($sender->id == $user->id) right @endif" id="message{{ $message->id }}">
            <div class="user-list__nameThumb">
                <div class="thumb">
                    <img src="{{ $sender->profilePicture() }}" alt="">
                </div>
                <div class="chatbox-body__textDate">
                    @if ($message->message)
                        <span class="chatbox-body__text">{{ $message->message }}</span>
                    @endif
                    @if ($message->file)
                        <span class="">
                            <img src="{{ getImage(getFilePath('message') . '/' . $message->file) }}" alt="@lang('File')">
                        </span>
                    @endif
                    <span class="chatbox-body__date d-block">{{ diffForHumans($message->created_at) }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
