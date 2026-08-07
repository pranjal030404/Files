<?php
    $blogContent = getContent('blog.content', true);
    $blogElement = getContent('blog.element', false, 8);
?>

<?php if($blogElement->isNotEmpty()): ?>
    <!-- Blog Section  Start-->
    <div class="section">
        <div class="section__head">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-xl-6">
                        <h2 class="mt-0 text-center"><?php echo e(__(@$blogContent->data_values->heading)); ?></h2>
                        <p class="section__para mx-auto mb-0 text-center">
                            <?php echo e(__(@$blogContent->data_values->subheading)); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php echo $__env->make($activeTemplate . 'partials.blog_grid', ['blogs' => $blogElement], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
    <!-- Blog Section End -->
<?php endif; ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/blog.blade.php ENDPATH**/ ?>