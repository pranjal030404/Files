<?php $__env->startSection('panel'); ?>
    <?php echo $__env->yieldPushContent('fbComment'); ?>

    <div class="preloader">
        <div class="preloader__loader">
            <i class="las la-heart"></i>
        </div>
    </div>
    <div class="back-to-top">
        <span class="back-top">
            <i class="las la-angle-double-up"></i>
        </span>
    </div>
    <div class="body-overlay" id="body-overlay"></div>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="search-popup" id="search-popup">
        <form class="search-form" action="#">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Search....." />
            </div>
            <button class="submit-btn xl-text" type="submit">
                <i class="las la-search"></i>
            </button>
        </form>
    </div>
    <div class="toggle-overlay"></div>

    <?php if(!request()->routeIs('maintenance-mode') && gs('maintenance_mode') == \App\Constants\Status::DISABLE): ?>
        <?php echo $__env->make($activeTemplate . 'partials.header_top', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make($activeTemplate . 'partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>

    <?php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    ?>
    <?php if($cookie->data_values->status == Status::ENABLE && !\Cookie::get('gdpr_cookie')): ?>
        <div class="cookies-card hide text-center">
            <div class="cookies-card__icon bg--base">
                <i class="las la-cookie-bite"></i>
            </div>
            <p class="cookies-card__content mt-4"><?php echo e(__($cookie->data_values->short_desc)); ?>

                <a href="<?php echo e(route('cookie.policy')); ?>" target="_blank"><?php echo app('translator')->get('learn more'); ?></a>
            </p>
            <button class="btn btn--base w-100 policy mt-3" type="button"><?php echo app('translator')->get('Allow'); ?></button>
        </div>
    <?php endif; ?>

    <?php echo $__env->make($activeTemplate . 'partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.policy').on('click', function() {
                $.get('<?php echo e(route('cookie.accept')); ?>', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/layouts/frontend.blade.php ENDPATH**/ ?>