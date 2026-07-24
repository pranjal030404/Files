<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(gs()->siteName($pageTitle ?? '')); ?></title>

    <link rel="shortcut icon" type="image/png" href="<?php echo e(siteFavicon()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/bootstrap-toggle.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/app.css')); ?>">


    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
    
<?php echo $__env->yieldContent('content'); ?>

<script src="<?php echo e(asset('assets/global/js/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/vendor/bootstrap-toggle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/cu-modal.js')); ?>"></script>


<?php echo $__env->make('partials.notify', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldPushContent('script-lib'); ?>

<script src="<?php echo e(asset('assets/global/js/nicEdit.js')); ?>"></script>

<script src="<?php echo e(asset('assets/global/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/app.js')); ?>"></script>


<script>
    "use strict";
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });
    (function($){
        $( document ).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });

        $('.breadcrumb-nav-open').on('click', function() {
            $(this).toggleClass('active');
            $('.breadcrumb-nav').toggleClass('active');
        });

        $('.breadcrumb-nav-close').on('click', function() {
            $('.breadcrumb-nav').removeClass('active');
        });

        if($('.topTap').length){
            $('.breadcrumb-nav-open').removeClass('d-none');
        }
    })(jQuery);
</script>

<?php echo $__env->yieldPushContent('script'); ?>


</body>
</html>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>