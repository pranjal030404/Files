@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- Blog Details  -->
    <div class="section bg-light">
        <div class="container">
            <div class="row gy-5 g-lg-4">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-details">
                        <div class="blog-details__img">
                            <img alt="@lang('Blog Image')" class="img-fluid w-100" src="{{ frontendImage('blog', $blog->data_values->image, '728x465') }}" />
                        </div>

                        <div class="blog-details__body">
                            <h4>
                                {{ __(@$blog->data_values->title) }}
                            </h4>
                            @php
                                echo trans(@$blog->data_values->description);
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title mt-0 mb-0">@lang('Popular Post')</h5>
                            @foreach ($popularBlogs as $popular)
                                <div class="blog-sidebar__card">
                                    <div class="blog-sidebar__card-thumb">
                                        <a href="{{ route('blog.details', $popular->slug) }}"><img alt="@lang('Popular Post')" src="{{ frontendImage('blog', 'thumb_' . $popular->data_values->image, '310x205') }}" /></a>
                                    </div>
                                    <div class="blog-sidebar__card-content">
                                        <h6 class="blog-sidebar__card-title mt-0 mb-1"><a href="{{ route('blog.details', $popular->slug) }}">
                                                @php
                                                    echo strLimit(trans($popular->data_values->title), 40);
                                                @endphp
                                            </a></h6>
                                        <p class="blog-sidebar__card-desc mb-0">
                                            @php
                                                echo strLimit(strip_tags($popular->data_values->description), 70);
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title mt-0 mb-0">@lang('Latest Post')</h5>
                            @foreach ($latestBlogs as $latest)
                                <div class="blog-sidebar__card">
                                    <div class="blog-sidebar__card-thumb">
                                        <a href="{{ route('blog.details', $latest->slug) }}"><img alt="@lang('Latest Post')" src="{{ frontendImage('blog', 'thumb_' . $latest->data_values->image, '310x205') }}" /></a>
                                    </div>
                                    <div class="blog-sidebar__card-content">
                                        <h6 class="blog-sidebar__card-title mt-0 mb-1">
                                            <a href="{{ route('blog.details', $latest->slug) }}">
                                                @php
                                                    echo strLimit(trans($latest->data_values->title), 40);
                                                @endphp
                                            </a>

                                        </h6>
                                        <p class="blog-sidebar__card-desc mb-0">
                                            @php
                                                echo strLimit(strip_tags($latest->data_values->description), 70);
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details End -->
@endsection
@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
