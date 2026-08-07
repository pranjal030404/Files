<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
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
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
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
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<?php
    $size = $size ?? getFileSize($type);
    $imagePath = $imagePath ?? getImage(getFilePath($type) . '/' . $image, $size);
?>
<div <?php echo e($attributes->merge(['class' => 'image--uploader'])); ?>>
    <div class="image-upload-wrapper">
        <div class="image-upload-preview <?php echo e($darkMode ? 'bg--dark' : ''); ?>" style="background-image: url(<?php echo e($imagePath); ?>)">
        </div>
        <div class="image-upload-input-wrapper">
            <input type="file" class="image-upload-input" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" accept="<?php echo e($accept); ?>" <?php if($required): echo 'required'; endif; ?>>
            <label for="<?php echo e($id); ?>" class="bg--primary"><i class="la la-cloud-upload"></i></label>
        </div>
    </div>

</div>
<?php if($showInfo): ?>
    <div class="mt-2">
        <small class="mt-3 text-muted"> <?php echo app('translator')->get('Supported Files:'); ?>
            <b><?php echo e($accept); ?>.</b>
            <?php if($size): ?>
                <?php echo app('translator')->get('Image will be resized into'); ?> <b><?php echo e($size); ?></b><?php echo app('translator')->get('px'); ?>
            <?php endif; ?>
        </small>
    </div>
<?php endif; ?>

<?php $__env->startPush('style'); ?>
    <style>
        .image-upload-preview {
            background-size: cover;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php if (! $__env->hasRenderedOnce('41eaaa6b-fc80-4ed3-85ff-ece6b3236ec4')): $__env->markAsRenderedOnce('41eaaa6b-fc80-4ed3-85ff-ece6b3236ec4');
$__env->startPush('script'); ?>
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
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/components/image-uploader.blade.php ENDPATH**/ ?>