@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'sections.banner')
    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @unless($sec == 'mobile_app')
                @include($activeTemplate . 'sections.' . $sec)
            @endunless
        @endforeach
    @endif
@endsection
