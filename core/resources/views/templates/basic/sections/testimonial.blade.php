@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElement = getContent('testimonial.element', false, 8);
@endphp

    <!-- Testimonial Section  -->
<div class="section section--bg">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$testimonialContent->data_values->heading) }}</h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        {{ __(@$testimonialContent->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row testimonial-slider">
            @foreach ($testimonialElement as $testimonial)
                <div class="testimonial-slider__item">
                    <div class="feedback-card">
                        <div class="feedback-card__thumb">
                            <div class="user">
                                <img class="user__img" src="{{ frontendImage('testimonial', @$testimonial->data_values->profile_picture, '120x120') }}" alt="@lang('Profile Picture')">
                            </div>
                        </div>
                        <!-- -->
                        <p class="feedback-card__para">
                            {{ __($testimonial->data_values->speech) }}
                        </p>
                        <div class="feedback-card__footer">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="user__content">
                                    <h6 class="m-0"> {{ __($testimonial->data_values->name) }}</h6>
                                    <p class="mb-0"> {{ __($testimonial->data_values->designation) }} </p>
                                </div>
                                <ul class="user__rating list d-flex align-items-center flex-row gap-1">
                                    @php echo displayRating($testimonial->data_values->star); @endphp
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Testimonial Section End -->
