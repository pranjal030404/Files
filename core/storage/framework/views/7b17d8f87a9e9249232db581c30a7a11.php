<?php
    $content = getContent('faq.content', true);
    $faqs = getContent('faq.element', false, null, true);
?>
<div class="section section--bg">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        <?php echo e(__(@$content->data_values->subheading)); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="accordion custom--accordion" id="faq">
            <div class="row faq-bg gy-3">
                <div class="col-lg-6">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->odd): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faq-<?php echo e($faq->id); ?>" data-bs-toggle="collapse" type="button">
                                        <?php echo e(__($faq->data_values->question)); ?>

                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="faq-<?php echo e($faq->id); ?>" data-bs-parent="#faq">
                                    <div class="accordion-body">
                                        <?php echo e(__($faq->data_values->answer)); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-lg-6">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->even): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faq-<?php echo e($faq->id); ?>" data-bs-toggle="collapse" type="button">
                                        <?php echo e(__($faq->data_values->question)); ?>

                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="faq-<?php echo e($faq->id); ?>" data-bs-parent="#faq">
                                    <div class="accordion-body">
                                        <?php echo e(__($faq->data_values->answer)); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>