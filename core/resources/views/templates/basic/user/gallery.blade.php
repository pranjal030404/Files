@extends('Template::layouts.master')
@section('content')
    @if (checkValidityPeriod($user->limitation) && ($user->limitation->image_upload_limit == '-1' || $user->limitation->image_upload_limit - $user->galleries->count() > 0))
        <div class="row">
            <form action="" enctype="multipart/form-data" method="post">
                @csrf
                <div class="input-images"></div>
                <button class="btn btn--base w-100 mt-3 mb-3" type="submit">@lang('Submit')</button>
            </form>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    @if (!checkValidityPeriod($user->limitation))
                        <p class="mb-0">@lang('Your package has been expired') <span class="fw-600">{{ diffForHumans($user->limitation?->expire_date) }}</span></p>
                    @else
                        <p class="mb-0">@lang('Your image upload limit is over!')</p>
                    @endif
                    @if (gs('default_package_id'))
                        <small>@lang('Please remove some images. Or purchase package from ')
                            <a class="text--base" href="{{ route('packages') }}">@lang('packages')</a>
                        </small>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if ($maxLimit != -1 && $user->galleries->count() > $maxLimit)
        <div class="text-end">
            <button class="btn btn--danger confirmationBtn mb-3" data-action="{{ route('user.gallery.unpublished.delete') }}" data-question="@lang('Are you sure, you want to delete all unpublished images?')" type="button"><i class="las la-trash-alt"></i>@lang('Delete All unpublished image')</button>
        </div>
    @endif
    @if ($user->galleries->count())
        <div class="row g-0 filter-container p-0">
            @foreach ($user->galleries as $userImage)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 grid-item" data-category="1" data-sort="value">
                    <div class="profile-gallery position-relative">
                        @if ($loop->iteration > $maxLimit)
                            <span class="image-status">@lang('Unpublished')</span>
                        @endif
                        <div class="profile-gallery__thumb">
                            <img src="{{ getImage(getFilePath('gallery') . '/' . $userImage->image) }}" alt="">
                            <div class="profile-gallery__icon">
                                <a class="magnific-gallery" href="{{ getImage(getFilePath('gallery') . '/' . $userImage->image) }}"><i class="fas fa-search-plus"></i> </a>
                                <button class="delete-icon" data-gallery_id="{{ $userImage->id }}" type="button"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="modal fade" id="deleteGallery" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation Alert!')</h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('user.gallery.delete') }}" method="POST">
                    @csrf
                    <input name="gallery_id" type="hidden">
                    <div class="modal-body text-center">
                        <p class="mb-0">{{ __('Are you sure that you want to delete this image?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark btn--sm" data-bs-dismiss="modal" type="button">@lang('No')</button>
                        <button class="btn btn--base btn--sm" type="submit">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($user->galleries->count() > $maxLimit)
        <x-confirmation-modal />
    @endif
@endsection

@push('style')
    <style>
        .image-status {
            right: 5px;
            top: 5px;
            padding: 5px;
            border-radius: 5px;
            background-color: #f73f1e;
            color: #fff;
            position: absolute;
            font-size: 12px;
            z-index: 1;
        }

        .modal-body p,
        .modal-body small {
            font-size: 13px;
        }

        .modal-header button {
            border: none;
            border-radius: 50%;
            margin-top: 10px;
        }

        .modal-title {
            margin-top: 15px;
        }
    </style>
@endpush

@push('script-lib')
    <!--Image uploader-->
    <script src="{{ asset($activeTemplateTrue . 'js/image-uploader.min.js') }}"></script>
@endpush

@push('style-lib')
    <!--Image uploader-->
    <link href="{{ asset($activeTemplateTrue . 'css/image-uploader.min.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            let userImageUploadLimit = {{ $user->limitation?->image_upload_limit }};
            let totalUploaded = {{ $user->galleries->count() }};
            let options = {};
            if (userImageUploadLimit != -1) {
                let countLimit = userImageUploadLimit - totalUploaded;
                let uploadLimitCal = countLimit > 0 ? countLimit : 1;
                options = {
                    label: `@lang('Drag & Drop files here or click to browse. Select maximum') ${uploadLimitCal} ${uploadLimitCal==1 ? "@lang('image')" : "@lang('images')"}`,
                    maxFiles: uploadLimitCal
                };
            }
            $('.input-images').imageUploader(options);

            $('.delete-icon').on('click', function() {
                let modal = $('#deleteGallery');
                let galleryId = $(this).data('gallery_id');

                modal.find('[name=gallery_id]').val(galleryId);
                modal.modal('show');
            })

        })(jQuery);
    </script>
@endpush
