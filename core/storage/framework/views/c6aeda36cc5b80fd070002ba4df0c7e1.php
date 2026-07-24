<?php $__env->startSection('content'); ?>
<div class="login-main"
    style="background-image: url('<?php echo e(asset('assets/admin/images/login.jpg')); ?>')">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8 col-sm-11">
                <div class="login-area">
                    <div class="login-wrapper">
                        <div class="login-wrapper__top">
                            <h3 class="title text-white"><?php echo app('translator')->get('Welcome to'); ?> <strong><?php echo e(__(gs('site_name'))); ?></strong></h3>
                            <p class="text-white"><?php echo e(__($pageTitle)); ?> <?php echo app('translator')->get('to'); ?> <?php echo e(__(gs('site_name'))); ?>

                                <?php echo app('translator')->get('Dashboard'); ?></p>
                        </div>
                        <div class="login-wrapper__body">
                            <form action="<?php echo e(route('admin.login')); ?>" method="POST"
                                class="cmn-form mt-30 verify-gcaptcha login-form">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Username'); ?></label>
                                    <input type="text" class="form-control" value="<?php echo e(old('username')); ?>" name="username" required>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label><?php echo app('translator')->get('Password'); ?></label>
                                        <a href="<?php echo e(route('admin.password.reset')); ?>" class="forget-text"><?php echo app('translator')->get('Forgot Password?'); ?></a>
                                    </div>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Captcha::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
                                <button type="submit" class="btn cmn-btn w-100"><?php echo app('translator')->get('LOGIN'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>