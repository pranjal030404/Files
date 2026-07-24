<?php
    $content = getContent('mobile_app.content', true);
    $elements = getContent('mobile_app.element', false, 2, true);
?>
<div class="section--sm section--bottom">
    <div class="container">
        <div class="row g-4 align-items-center flex-wrap-reverse">
            <div class="col-lg-6 order-lg-2">
                <div class="mobile-app-thumb">
                    <img alt="<?php echo app('translator')->get('Mobile App'); ?>" src="<?php echo e(frontendImage('mobile_app', @$content->data_values->right_side_image, '690x610')); ?>" />
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="left-heading mt-0"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                <p class="section__para lg-text"><?php echo e(__(@$content->data_values->subheading)); ?></p>
                <p class="section__para"><?php echo e(__(@$content->data_values->description)); ?></p>

                <?php if($elements->count()): ?>
                    <div class="mt-5">
                        <ul class="list list--row align-items-center flex-wrap" style="--gap: 2rem;">
                            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="t-link" href="<?php echo e($element->data_values->link); ?>" target="_blank">
                                        <img alt="<?php echo app('translator')->get('Google Play'); ?>" class="img-fluid" src="<?php echo e(frontendImage('mobile_app', $element->data_values->link_image, '200x60')); ?>">
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/mobile_app.blade.php ENDPATH**/ ?>