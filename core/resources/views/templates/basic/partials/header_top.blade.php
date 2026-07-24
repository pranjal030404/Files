@php
    $contactContent = getContent('contact_us.content', true);
    $socialElement = getContent('social_icon.element', false, 4, true);
@endphp
    <!-- Header Top  -->
<div class="header-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-md-8">
                <ul class="list list--row header-top__list">
                    <li>
                        <a class="t-link d-flex align-items-center" href="mailto:{{ @$contactContent->data_values->email }}">
                            <div class="header-top__icon me-3">
                                <i class="far fa-paper-plane"></i>
                            </div>
                            <span class="header-top__para d-none d-md-inline-block sm-text text-clr">
                                {{ @$contactContent->data_values->email }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="t-link d-flex align-items-center" href="tel:{{ @$contactContent->data_values->contact_number }}">
                            <div class="header-top__icon me-3">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <span class="header-top__para d-none d-md-inline-block sm-text text-clr">
                                {{ @$contactContent->data_values->contact_number }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-4">
                <ul class="social-icons list list--row justify-content-end" style="--gap: .5rem;">
                    @foreach ($socialElement as $socialIcon)
                        <li class="social-icons__item">
                            <a class="social-icons__link t-link social-icon icon icon--circle icon--xxs" href="{{ $socialIcon->data_values->url }}" target="_blank">
                                @php
                                    echo $socialIcon->data_values->social_icon;
                                @endphp
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Header Top End -->
