@php
    $content = getContent('about.content', true);
    $element = getContent('about.element', false, 6, true);
@endphp

<div class="section">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img class="about-img__is" src="{{ frontendImage('about' , @$content->data_values->image, '635x635') }}" alt="@lang('About Us')" />
                    <a class="t-link btn about-img__btn" href="{{ @$content->data_values->video_url }}">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-3 ps-xl-5">
                    <h2 class="left-heading mt-0">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="section__para pt-3">
                        {{ __(@$content->data_values->description) }}
                    </p>
                    <div class="row g-4">
                        @foreach ($element as $about)
                            <div class="col-md-6">
                                <ul class="about-lists list list--row">
                                    <li>
                                        <div class="icon icon--base icon--eclipse icon--md">
                                            @php echo $about->data_values->icon; @endphp
                                        </div>
                                    </li>
                                    <li>
                                        <h5 class="m-0">{{ __($about->data_values->item) }}</h5>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
{{--                    <div class="mt-5">--}}
{{--                        <a class="btn  btn--base sm-text" href="{{ url(@$content->data_values->button_url) }}"> {{ __(@$content->data_values->button_text) }} </a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
