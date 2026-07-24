@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-12">
        @include($activeTemplate.'partials.interest_request_table', ['interestRequests' => $interestRequests, 'pagination' => true])
        @if ($interestRequests->hasPages())
            <div class="mt-3 text-center">
                {{ paginateLinks($interestRequests) }}
            </div>
        @endif
    </div>
@endsection

@push('breadcrumb-plugins')
    <form action="">
        <div class="input-group">
            <input class="form-control form--control bg-white" name="search" value="{{ request()->search }}" type="text">
            <button class="input-group-text btn btn--base" type="submit"><i class="las la-search"></i></button>
        </div>
    </form>
@endpush
