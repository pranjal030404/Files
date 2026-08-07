<?php $__env->startSection('content'); ?>
    <!-- Blog Details  -->
    <div class="section bg-light">
        <div class="container">
            <div class="row gy-5 g-lg-4">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-details">
                        <div class="blog-details__img">
                            <img alt="<?php echo app('translator')->get('Blog Image'); ?>" class="img-fluid w-100" src="<?php echo e(frontendImage('blog', $blog->data_values->image, '728x465')); ?>" />
                        </div>

                        <div class="blog-details__body">
                            <h4>
                                <?php echo e(__(@$blog->data_values->title)); ?>

                            </h4>
                            <?php
                                echo trans(@$blog->data_values->description);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title mt-0 mb-0"><?php echo app('translator')->get('Popular Post'); ?></h5>
                            <?php $__currentLoopData = $popularBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="blog-sidebar__card">
                                    <div class="blog-sidebar__card-thumb">
                                        <a href="<?php echo e(route('blog.details', $popular->slug)); ?>"><img alt="<?php echo app('translator')->get('Popular Post'); ?>" src="<?php echo e(frontendImage('blog', 'thumb_' . $popular->data_values->image, '310x205')); ?>" /></a>
                                    </div>
                                    <div class="blog-sidebar__card-content">
                                        <h6 class="blog-sidebar__card-title mt-0 mb-1"><a href="<?php echo e(route('blog.details', $popular->slug)); ?>">
                                                <?php
                                                    echo strLimit(trans($popular->data_values->title), 40);
                                                ?>
                                            </a></h6>
                                        <p class="blog-sidebar__card-desc mb-0">
                                            <?php
                                                echo strLimit(strip_tags($popular->data_values->description), 70);
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title mt-0 mb-0"><?php echo app('translator')->get('Latest Post'); ?></h5>
                            <?php $__currentLoopData = $latestBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="blog-sidebar__card">
                                    <div class="blog-sidebar__card-thumb">
                                        <a href="<?php echo e(route('blog.details', $latest->slug)); ?>"><img alt="<?php echo app('translator')->get('Latest Post'); ?>" src="<?php echo e(frontendImage('blog', 'thumb_' . $latest->data_values->image, '310x205')); ?>" /></a>
                                    </div>
                                    <div class="blog-sidebar__card-content">
                                        <h6 class="blog-sidebar__card-title mt-0 mb-1">
                                            <a href="<?php echo e(route('blog.details', $latest->slug)); ?>">
                                                <?php
                                                    echo strLimit(trans($latest->data_values->title), 40);
                                                ?>
                                            </a>

                                        </h6>
                                        <p class="blog-sidebar__card-desc mb-0">
                                            <?php
                                                echo strLimit(strip_tags($latest->data_values->description), 70);
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details End -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('fbComment'); ?>
    <?php echo loadExtension('fb-comment') ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/blog_details.blade.php ENDPATH**/ ?>