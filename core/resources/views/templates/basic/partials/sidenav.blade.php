@php
    use App\Constants\Status;
    $user = auth()->user()->load('interestRequests');
    $pendingInterestRequestCount = $user->interestRequests->where('status', Status::NO)->count();
    $unseenMessageCount = App\Models\Message::where('receiver_id', $user->id)
        ->where('read_status', Status::NO)
        ->count();
@endphp

<div class="col-lg-4 col-xl-3">
    <div class="dashboard-sidenav">
        <div class="dashboard-sidenav__close d-lg-none d-block">
            <button class="dashboard-sidenav__close-icon" type="button"><i class="las la-times"></i></button>
        </div>
        <div class="dashboard-profile">
            <div class="team-card" style="width: 100%; display: inline-block;">
                <div class="team-card__img mx-auto">
                    <img class="team-card__img-is" src="{{ $user->profilePicture() }}" alt="@lang('Profile Image')">
                    <button class="profile-picture" type="button"><i class="las la-pencil-alt"></i></button>
                </div>

                <div class="team-card__body text-center">
                    <h5 class="dashboard-profile__name team-card__body-name mb-0">{{ $user->fullname }}</h5>
                    <h6 class="dashboard-profile__id team-card__body-id my-2"> @lang('ID') :
                        {{ $user->profile_id }} </h6>
                    <a class="btn btn--light-bg sm-text fw-md w-100 mt-2" href="{{ route('user.member.profile.public', $user->id) }}">@lang('Public Profile')</a>
                </div>
            </div>
        </div>
        <nav class="dashboard-menu">
            <ul class="list menu-item" style="--gap: 0;">
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.home') }}" href="{{ route('user.home') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-layer-group"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Dashboard') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.purchase.history') }}" href="{{ route('user.purchase.history') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-cog"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Purchase History') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.gallery') }}" href="{{ route('user.gallery') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-image"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Gallery') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.shortlist') }}" href="{{ route('user.shortlist') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-list"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Shortlist') </span>
                    </a>
                </li>

                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.interest.list') }}" href="{{ route('user.interest.list') }}">
                        <span class="dashboard-menu__icon">
                            <i class="la la-heart-o"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('My Interest') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.interest.requests') }}" href="{{ route('user.interest.requests') }}">
                        <span class="dashboard-menu__icon">
                            <i class="la la-heart-o"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Interest Request') </span>
                        @if ($pendingInterestRequestCount)
                            <span class="dashboard-menu__noti">{{ $pendingInterestRequestCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.ignored.list') }}" href="{{ route('user.ignored.list') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-ban"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Ignored Lists') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.message.index') }}" href="{{ route('user.message.index') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-envelope"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Message') </span>
                        @if ($unseenMessageCount)
                            <span class="dashboard-menu__noti"> {{ $unseenMessageCount }} </span>
                        @endif
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('ticket.*') }}" href="{{ route('ticket.index') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-ticket-alt"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Support Tickets') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.profile.setting') }}" href="{{ route('user.profile.setting') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-user"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Profile Setting') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link {{ menuActive('user.change.password') }}" href="{{ route('user.change.password') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-key"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Change Password') </span>
                    </a>
                </li>
                <li>
                    <a class="t-link dashboard-menu__link" href="{{ route('user.logout') }}">
                        <span class="dashboard-menu__icon">
                            <i class="las la-sign-out-alt"></i>
                        </span>
                        <span class="dashboard-menu__text"> @lang('Sign Out') </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Report Modal -->
<div class="modal custom--modal fade" id="profilePictureModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Change Profile Picture')</h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.profile.picture.update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-2">@lang('Profile Picture')</label>
                        <div class="image-upload">
                            <div class="image-upload">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }})">
                                            <button class="remove-image" type="button"><i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input class="profilePicUpload" id="profilePicUpload1" name="image" type="file" accept=".png, .jpg, .jpeg">
                                        <label class="bg--dark text-white" for="profilePicUpload1">@lang('Upload Image')</label>
                                        <small class="mt-2">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png').</b> @lang('Image will be resized into '){{ getFileSize('userProfile') }}@lang('px')
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.profile-picture').on('click', function() {
                let modal = $('#profilePictureModal');
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .profile-picture {
            border: 0;
            background-color: #f114ab;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            position: absolute;
            right: 0;
            bottom: 0;
            outline: 2px solid #fff;
        }

        .profile-picture:focus {
            outline: 2px solid #fff !important;
        }
    </style>
@endpush
