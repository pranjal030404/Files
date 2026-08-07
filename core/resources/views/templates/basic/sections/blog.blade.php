@php
    $blogContent = getContent('blog.content', true);
    $blogElement = getContent('blog.element', false, 8);
@endphp

@if($blogElement->isNotEmpty())
    <!-- Blog Section  Start-->
    <div class="section">
        <div class="section__head">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-xl-6">
                        <h2 class="mt-0 text-center">{{ __(@$blogContent->data_values->heading) }}</h2>
                        <p class="section__para mx-auto mb-0 text-center">
                            {{ __(@$blogContent->data_values->subheading) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @include($activeTemplate . 'partials.blog_grid', ['blogs' => $blogElement])
        </div>
    </div>
    <!-- Blog Section End -->
@endif
