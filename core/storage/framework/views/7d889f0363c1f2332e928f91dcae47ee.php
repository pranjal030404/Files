<?php $__env->startSection('content'); ?>
    <?php
        $contactContent = getContent('contact_us.content', true);
    ?>
    <div class="section--sm section--top bg--light">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card__icon-container text-center">
                            <div class="contact-card__icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                        <div class="contact-card__body">
                            <h5 class="mt-md-0"><?php echo e(__(@$contactContent->data_values->office_address_title)); ?></h5>
                            <p><?php echo e(__(@$contactContent->data_values->office)); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card__icon-container text-center">
                            <div class="contact-card__icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="contact-card__body">
                            <h5 class="mt-md-0"><?php echo e(__(@$contactContent->data_values->email_address_title)); ?></h5>
                            <a href="mailto:<?php echo e(@$contactContent->data_values->email); ?>"><?php echo e(__(@$contactContent->data_values->email)); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card__icon-container text-center">
                            <div class="contact-card__icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </div>
                        <div class="contact-card__body">
                            <h5 class="mt-md-0"><?php echo e(__(@$contactContent->data_values->contact_number_title)); ?></h5>
                            <a href="tel:<?php echo e(@$contactContent->data_values->contact_number); ?>"><?php echo e(__(@$contactContent->data_values->contact_number)); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section--sm section--bottom bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3 class="form-title mt-0"><?php echo e(@$contactContent->data_values->title); ?></h3>
                            </div>
                            <form class="verify-gcaptcha" action="" autocomplete="off" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-12 <?php if(auth()->guard()->check()): ?> d-none <?php endif; ?> mt-4">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="name" name="name" type="text" value="<?php echo e(auth()->user() ? auth()->user()->fullname : old('name')); ?>" <?php if(auth()->user()): ?> readonly <?php endif; ?> required placeholder=" ">
                                            <label class="form--label" for="name"><?php echo app('translator')->get('Name'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 <?php if(auth()->guard()->check()): ?> d-none <?php endif; ?> mt-4">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="email" name="email" type="email" value="<?php echo e(auth()->user() ? auth()->user()->email : old('email')); ?>" <?php if(auth()->user()): ?> readonly <?php endif; ?> required>
                                            <label class="form--label" for="email"><?php echo app('translator')->get('Email Address'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <div class="input--group">
                                            <input class="form-control form--control" id="subject" name="subject" type="text" value="<?php echo e(old('subject')); ?>" required>
                                            <label class="form--label" for="subject"><?php echo app('translator')->get('Subject'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <div class="input--group">
                                            <textarea class="form-control form--control" id="message" name="message" required><?php echo e(old('message')); ?></textarea>
                                            <label class="form--label" for="message"><?php echo app('translator')->get('Message'); ?></label>
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

                                    <div class="col-sm-12">
                                        <button class="btn btn--base w-100 mt-3" type="submit"><?php echo e(__(@$contactContent->data_values->button_text)); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-img">
                        <img class="contact-img__is" src="<?php echo e(frontendImage('contact_us', @$contactContent->data_values->image, '800x550')); ?>" alt="<?php echo app('translator')->get('Contact Us'); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($sections != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make(activeTemplate() . 'sections.' . $sec, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'Template::layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>