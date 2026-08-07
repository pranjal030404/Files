<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-between align-items-center flex-wrap gap-2">
                        <h4><?php echo app('translator')->get('Content Management Options'); ?></h4>
                        <div class="position-relative">
                            <div class="system-search-icon"><i class="las la-search"></i></div>
                            <input class="form-control searchInput" type="search" placeholder="<?php echo app('translator')->get('Search'); ?>...">
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-12 m-0">
                            <div class="emptyArea"></div>
                        </div>
                        <?php $__currentLoopData = getPageSections(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $secs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($secs['builder'] && (!isset($secs['hide_builder']) || (isset($secs['hide_builder']) && !$secs['hide_builder']))): ?>
                                <div class="col-md-3 searchItem">
                                    <div class="frontend-section-card">
                                        <h6><?php echo e(__($secs['name'])); ?></h6>
                                        <div class="d-flex align-items-center gap-1">
                                            <?php if(isset($secs['element'])): ?>
                                                <a href="<?php echo e(route('admin.frontend.sections.element', $k)); ?>" class="btn btn-sm btn-outline--primary"><i class="las la-plus"></i><?php echo app('translator')->get('Add'); ?></a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('admin.frontend.sections', $k)); ?>" class="btn btn--light btn-sm"><i class="las la-cog me-0"></i></a>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .frontend-section-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ededed;
            padding: 15px;
            border-radius: 5px;
            background: #fff;
            transition: all .2s;
        }

        .frontend-section-card:hover {
            background: #e7e7e7;
        }

        .system-search-icon {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            aspect-ratio: 1;
            padding: 5px;
            display: grid;
            place-items: center;
            color: #888;
        }

        .searchInput {
            border: 1px solid #ededed;
        }

        .system-search-icon~.form-control {
            padding-left: 45px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            var searchInput = $('.searchInput');
            var searchItem = $('.searchItem');

            var emptyArea = $('.emptyArea');
            var emptyHtml = `<div class="searchItem text-center mt-4"><div class="empty-notification-list text-center">
                        <img src="<?php echo e(getImage('assets/images/empty_list.png')); ?>" alt="empty">
                        <h5 class="text-muted"><?php echo app('translator')->get('No search result found'); ?></h5>
                    </div></div>`;

            searchInput.on('input', function() {
                var searchInput = $(this).val().toLowerCase();
                var empty = true;

                searchItem.filter(function(idx, elem) {

                    if ($(elem).find('.frontend-section-card h6').text().trim().toLowerCase().indexOf(searchInput) >= 0) {
                        $(elem).show();
                        emptyArea.empty();
                        empty = false;
                    } else {
                        $(elem).hide();
                    }

                }).sort();

                if (empty) {
                    emptyArea.html(emptyHtml);
                }

            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/frontend/index.blade.php ENDPATH**/ ?>