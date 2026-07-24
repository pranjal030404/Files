@php
    $counterElement = getContent('counter.element', false, 4, true);
@endphp

    <!-- Counter Section  -->
<div class="section--sm counter-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($counterElement as $counter)
                <div class="col-sm-6 col-xl-3">
                    <div class="counter-card">
                        <div class="counter-card__icon">
                            @php
                                echo $counter->data_values->icon;
                            @endphp
                        </div>
                        <div class="counter-card__content">
                            <h2 class="m-0 text--white">
                                <span class="odometer" data-odometer-final="{{ $counter->data_values->digits }}">0</span>
                            </h2>
                            <span class="d-block text--white lg-text fw-md">
                            {{ __($counter->data_values->title) }}
                        </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Counter Section End -->
