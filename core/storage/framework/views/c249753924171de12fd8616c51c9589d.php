<?php $__env->startSection('content'); ?>
    <div class="login section">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login__wrapper">
                        <div class="section__head text-center">
                            <h2 class="mt-0 login-title"><?php echo e(__(@$loginContent->data_values->heading)); ?></h2>
                            <p class="t-short-para mx-auto text-center mb-0">
                                <?php echo e(__(@$loginContent->data_values->subheading)); ?>

                            </p>
                        </div>
                        <form action="<?php echo e(route('user.login')); ?>" autocomplete="off" class="verify-gcaptcha" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-12 mt-0">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="user-name" name="username" required type="text" value="<?php echo e(old('username')); ?>">
                                        <label class="form--label" for="user-name"><?php echo app('translator')->get('Username or Email'); ?></label>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="password" name="password" required type="password">
                                        <label class="form--label" for="password"><?php echo app('translator')->get('Password'); ?></label>
                                        <div class="fa fa-fw fa-eye field-icon toggle-password" id="#password"></div>
                                    </div>
                                </div>

                                <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve(['path' => $activeTemplate . 'partials.'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

                                <div class="col-sm-12 mt-4">

                                    <div class="input--group text-start d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="form--check">
                                            <input <?php echo e(old('remember') ? 'checked' : ''); ?> autocomplete="off" class="form-check-input" id="remember" name="remember" type="checkbox">
                                            <label class="form-check-label" for="remember"><?php echo app('translator')->get('Remember Me'); ?></label>
                                        </div>
                                        <a class="text--base" href="<?php echo e(route('user.password.request')); ?>">
                                            <?php echo app('translator')->get('Forgot your password?'); ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button class="btn  btn--base mt-3 w-100" type="submit">
                                        <?php echo app('translator')->get('Login'); ?>
                                    </button>
                                </div>

                                <div class="col-sm-12">
                                    <div class="login-account text-center">
                                        <p class="mb-0 mt-4"><?php echo app('translator')->get('Haven\'t any acoount? '); ?>
                                            <a href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Sign Up'); ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php echo $__env->make($activeTemplate . 'partials.social_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>