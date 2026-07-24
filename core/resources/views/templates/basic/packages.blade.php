@extends($activeTemplate . 'layouts.frontend')
@section('content')

    @include($activeTemplate . 'partials.package', ['packages' => $packages, 'totalPackage' => $packages->count()])

    <!-- Pricing Plan End -->
    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
