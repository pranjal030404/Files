<!doctype html>
<html itemscope itemtype="http://schema.org/WebPage" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title> <?php echo e(gs('site_name')); ?></title>
    <?php echo $__env->make('partials.seo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <link href="<?php echo e(asset('assets/global/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/global/css/all.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset($activeTemplateTrue . 'css/datepicker.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/slick.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/jquery-ui.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/magnific-popup.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/odometer-theme-default.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/main.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset($activeTemplateTrue . 'css/custom.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <?php echo $__env->yieldPushContent('style'); ?>

    <link href="<?php echo e(asset($activeTemplateTrue . 'css/color.php')); ?>?color=<?php echo e(gs('base_color')); ?>&secondColor=<?php echo e(gs('secondary_color')); ?>" rel="stylesheet">
</head>
<?php echo loadExtension('google-analytics') ?>

<body>
    <?php echo $__env->yieldPushContent('fbComment'); ?>
    <?php echo $__env->yieldContent('panel'); ?>
    <script src="<?php echo e(asset('assets/global/js/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/slick.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/jquery.magnific-popup.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/jquery.filterizr.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/jquery.ui.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/viewport.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/odometer.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script-lib'); ?>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/app.js')); ?>"></script>

    <?php echo loadExtension('tawk-chat') ?>

    <?php echo $__env->make('partials.notify', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(gs('pn')): ?>
        <?php echo $__env->make('partials.push_script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('script'); ?>

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "<?php echo e(route('home')); ?>/change/" + $(this).val();
            });

            var inputElements = $('[type=text], textarea, [type=email], [type=password], [type=number]');
            $.each(inputElements, function(index, element) {
                element = $(element);
                if (!element.attr('id')) {
                    element.attr('id', element.attr('name'));
                }
                element.closest('.input--group').find('label').attr('for', element.attr('id'));
            });

        })(jQuery);
    </script>
</body>

</html>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/layouts/app.blade.php ENDPATH**/ ?>