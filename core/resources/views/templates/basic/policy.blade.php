@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            @php
                echo $policy->data_values->details;
            @endphp
        </div>
    </div>
@endsection
