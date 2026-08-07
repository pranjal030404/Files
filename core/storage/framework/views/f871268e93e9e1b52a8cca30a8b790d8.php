<?php $__env->startSection('content'); ?>
    <?php
        $content = getContent('stories.content', true);
    ?>
    <div class="section section--bg">
        <div class="section__head">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-xl-6">
                        <h2 class="mt-0 text-center"> <?php echo e(__(@$content->data_values->heading)); ?></h2>
                        <p class="section__para mx-auto mb-0 text-center">
                            <?php echo e(__(@$content->data_values->subheading)); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php echo $__env->make($activeTemplate . 'partials.stories_grid', ['stories' => $stories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php if($stories->hasPages()): ?>
                <?php echo e(paginateLinks($stories)); ?>

            <?php endif; ?>
        </div>
    </div>

    <?php if($sections != null): ?>
        <?php $__currentLoopData = json_decode($sections); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/stories.blade.php ENDPATH**/ ?>