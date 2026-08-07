@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $content = getContent('blog.content', true);
    @endphp
    <div class="section section--bg">
        <div class="section__head">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-xl-6">
                        <h2 class="mt-0 text-center"> {{ __(@$content->data_values->heading) }}</h2>
                        <p class="section__para mx-auto mb-0 text-center">
                            {{ __(@$content->data_values->subheading) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @include($activeTemplate . 'partials.blog_grid', ['blogs' => $blogs])
            @if ($blogs->hasPages())
                {{ paginateLinks($blogs) }}
            @endif
        </div>
    </div>

    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
