<div class="row g-0 filter-container">
    <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-4 col-md-6 grid-item" data-category="1" data-sort="value">
            <img alt="<?php echo app('translator')->get('Successful Story'); ?>" class="filter-img lazy-loading-img" src="<?php echo e(frontendImage('stories', 'thumb_' . $story->data_values->image, '310x205')); ?>" />
            <div class="grid-item__content">
                <h6 class="grid-item__name mb-1"><a class="text-decoration-none"><?php echo strLimit(trans($story->data_values->title),40) ?></a></h6>
                <p class="grid-item__desc">
                    <?php echo strLimit(strip_tags($story->data_values->description),70) ?>
                </p>
                <a class="grid-item__link" href="<?php echo e(route('story.details', $story->slug)); ?>"></a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/partials/stories_grid.blade.php ENDPATH**/ ?>