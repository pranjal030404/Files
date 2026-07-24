<?php
    $content = getContent('about.content', true);
    $element = getContent('about.element', false, 6, true);
?>

<div class="section">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img class="about-img__is" src="<?php echo e(frontendImage('about' , @$content->data_values->image, '635x635')); ?>" alt="<?php echo app('translator')->get('About Us'); ?>" />
                    <a class="t-link btn about-img__btn" href="<?php echo e(@$content->data_values->video_url); ?>">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-3 ps-xl-5">
                    <h2 class="left-heading mt-0"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    <p class="section__para pt-3">
                        <?php echo e(__(@$content->data_values->description)); ?>

                    </p>
                    <div class="row g-4">
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <ul class="about-lists list list--row">
                                    <li>
                                        <div class="icon icon--base icon--eclipse icon--md">
                                            <?php echo $about->data_values->icon; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <h5 class="m-0"><?php echo e(__($about->data_values->item)); ?></h5>
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>