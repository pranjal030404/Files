@php
    $credentials = gs('socialite_credentials');
    $text = isset($register) ? 'Register' : 'Login';
    $title = 'Or '.$text.' with';
@endphp
@if ($credentials->google->status == Status::ENABLE || $credentials->facebook->status == Status::ENABLE || $credentials->linkedin->status == Status::ENABLE)
    <div class="registration-socails mt-3">
        <div class="registration-socails__content text-center">
            <p class="registration-socails__desc mb-0 mt-0">{{ __($title) }}</p>
        </div>

        <ul class="registration-socails__list social-icons list list--row justify-content-center">
            @if ($credentials->google->status == Status::ENABLE)
                <li><a class="social-icons__link t-link social-icon icon icon--sqr icon--xxs" href="{{ route('user.social.login', 'google') }}"><i class="lab la-google"></i></a></li>
            @endif
            @if ($credentials->facebook->status == Status::ENABLE)
                <li><a class="social-icons__link t-link social-icon icon icon--sqr icon--xxs" href="{{ route('user.social.login', 'facebook') }}"><i class="lab la-facebook-f"></i></a></li>
            @endif
            @if ($credentials->linkedin->status == Status::ENABLE)
                <li><a class="social-icons__link t-link social-icon icon icon--sqr icon--xxs" href="{{ route('user.social.login', 'linkedin') }}"><i class="lab la-linkedin-in"></i></a></li>
            @endif
        </ul>
    </div>
@endif
