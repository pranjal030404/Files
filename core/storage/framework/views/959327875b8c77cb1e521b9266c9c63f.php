<?php
    $content = getContent('stories.content', true);
    $element = getContent('stories.element', false, 16);
?>

    <!-- Blog Section  Start-->
<div class="section blog-stories">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center text-white"> <?php echo e(__(@$content->data_values->heading)); ?></h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        <?php echo e(__(@$content->data_values->subheading)); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php echo $__env->make($activeTemplate . 'partials.stories_grid', ['stories' => $element], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>
<!-- Blog Section End -->
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/stories.blade.php ENDPATH**/ ?>