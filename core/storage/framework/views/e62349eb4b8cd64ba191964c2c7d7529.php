<?php
    $howWorkContent = getContent('how_it_work.content', true);
    $howWorkElement = getContent('how_it_work.element', false, 3, true);
?>

<div class="section work-process-section" style="background-image: url(<?php echo e(frontendImage('how_it_work', @$howWorkContent->data_values->background_image, '1910x425')); ?>)">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center"><?php echo e(__(@$howWorkContent->data_values->heading)); ?></h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        <?php echo e(__(@$howWorkContent->data_values->subheading)); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-5 justify-content-center">
            <?php $__currentLoopData = $howWorkElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $howWork): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4">
                    <div class="work-process">
                        <div class="work-process__icon">
                            <?php
                                echo $howWork->data_values->icon;
                            ?>
                            <span class="work-process__notification">
                                <?php echo e($loop->index + 1); ?>

                            </span>
                        </div>
                        <div class="work-process__content">
                            <h5 class="mt-0">
                                <?php echo e(__($howWork->data_values->title)); ?>

                            </h5>
                            <p class="mb-0">
                                <?php echo e(__($howWork->data_values->description)); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<!-- How it Works End -->
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/how_it_work.blade.php ENDPATH**/ ?>