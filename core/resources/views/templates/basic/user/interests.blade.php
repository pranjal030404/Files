@extends('Template::layouts.master')
@section('content')
    <div class="col-md-12">
        @include('Template::partials.interest_table', ['interests' => $interests, 'pagination' => true])
        @if ($interests->hasPages())
            <div class="mt-3 text-center">
                {{ paginateLinks($interests) }}
            </div>
        @endif
    </div>
@endsection

@push('breadcrumb-plugins')
    <form action="">
        <div class="input-group">
            <input class="form-control form--control bg-white" name="search" type="text" value="{{ request()->search }}">
            <button class="input-group-text btn btn--base" type="submit"><i class="las la-search"></i></button>
        </div>
    </form>
@endpush
