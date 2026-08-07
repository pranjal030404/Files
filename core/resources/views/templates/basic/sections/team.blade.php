@php
    $teamContent = getContent('team.content', true);
    $teamElement = getContent('team.element', false, 8, true);
@endphp

    <!-- Team Section  -->
<div class="section">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$teamContent->data_values->heading) }}</h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        {{ __(@$teamContent->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($teamElement as $member)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="feedback-card h-100 text-center">
                        <div class="feedback-card__thumb">
                            <div class="user">
                                <img class="user__img" src="{{ frontendImage('team', @$member->data_values->image, '300x300') }}" alt="@lang('Team Member')">
                            </div>
                        </div>
                        <div class="user__content">
                            <h5 class="m-0">{{ __(@$member->data_values->name) }}</h5>
                            <p class="mb-0">{{ __(@$member->data_values->designation) }}</p>
                            <p class="feedback-card__para mb-0">{{ __(@$member->data_values->speech) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
    <!-- Team Section End -->
