@props([
    'type' => null,
    'image' => null,
    'imagePath' => null,
    'size' => null,
    'name' => 'image',
    'id' => 'image-upload-input1',
    'accept' => '.png, .jpg, .jpeg',
    'required' => true,
    'darkMode' => false,
    'showInfo' => true,
])
@php
    $size = $size ?? getFileSize($type);
    $imagePath = $imagePath ?? getImage(getFilePath($type) . '/' . $image, $size);
@endphp
<div {{ $attributes->merge(['class' => 'image--uploader']) }}>
    <div class="image-upload-wrapper">
        <div class="image-upload-preview {{ $darkMode ? 'bg--dark' : '' }}" style="background-image: url({{ $imagePath }})">
        </div>
        <div class="image-upload-input-wrapper">
            <input type="file" class="image-upload-input" name="{{ $name }}" id="{{ $id }}" accept="{{ $accept }}" @required($required)>
            <label for="{{ $id }}" class="bg--primary"><i class="la la-cloud-upload"></i></label>
        </div>
    </div>

</div>
@if ($showInfo)
    <div class="mt-2">
        <small class="mt-3 text-muted"> @lang('Supported Files:')
            <b>{{ $accept }}.</b>
            @if ($size)
                @lang('Image will be resized into') <b>{{ $size }}</b>@lang('px')
            @endif
        </small>
    </div>
@endif

@push('style')
    <style>
        .image-upload-preview {
            background-size: cover;
        }
    </style>
@endpush

@pushOnce('script')
    <script>
        (function($) {
            "use strict";
            // Handle drag and drop events
            $('.image--uploader').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('dragging');
            });

            $('.image--uploader').on('dragleave', function(e) {
                e.preventDefault();
                $(this).removeClass('dragging');
            });

            $('.image--uploader').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('dragging');

                const files = e.originalEvent.dataTransfer.files;

                if (files.length) {
                    const fileInput = $(this).find('.image-upload-input')[0];
                    fileInput.files = files;
                    proPicURL(fileInput);
                }
            });
        })
        (jQuery);
    </script>
@endPushOnce
