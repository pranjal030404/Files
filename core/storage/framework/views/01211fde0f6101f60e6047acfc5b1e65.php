<?php
    $counterElement = getContent('counter.element', false, 4, true);
?>

    <!-- Counter Section  -->
<div class="section--sm counter-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <?php $__currentLoopData = $counterElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="counter-card">
                        <div class="counter-card__icon">
                            <?php
                                echo $counter->data_values->icon;
                            ?>
                        </div>
                        <div class="counter-card__content">
                            <h2 class="m-0 text--white">
                                <span class="odometer" data-odometer-final="<?php echo e($counter->data_values->digits); ?>">0</span>
                            </h2>
                            <span class="d-block text--white lg-text fw-md">
                            <?php echo e(__($counter->data_values->title)); ?>

                        </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<!-- Counter Section End -->
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/counter.blade.php ENDPATH**/ ?>