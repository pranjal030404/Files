@php
    $content = getContent('mobile_app.content', true);
    $elements = getContent('mobile_app.element', false, 2, true);
@endphp
<div class="section--sm section--bottom">
    <div class="container">
        <div class="row g-4 align-items-center flex-wrap-reverse">
            <div class="col-lg-6 order-lg-2">
                <div class="mobile-app-thumb">
                    <img alt="@lang('Mobile App')" src="{{ frontendImage('mobile_app', @$content->data_values->right_side_image, '690x610') }}" />
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="left-heading mt-0">{{ __(@$content->data_values->heading) }}</h2>
                <p class="section__para lg-text">{{ __(@$content->data_values->subheading) }}</p>
                <p class="section__para">{{ __(@$content->data_values->description) }}</p>

                @if ($elements->count())
                    <div class="mt-5">
                        <ul class="list list--row align-items-center flex-wrap" style="--gap: 2rem;">
                            @foreach ($elements as $element)
                                <li>
                                    <a class="t-link" href="{{ $element->data_values->link }}" target="_blank">
                                        <img alt="@lang('Google Play')" class="img-fluid" src="{{ frontendImage('mobile_app', $element->data_values->link_image, '200x60') }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
