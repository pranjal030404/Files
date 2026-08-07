<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="las la-check-double text--success"></i> <?php echo app('translator')->get('Compiled views will be cleared'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="las la-check-double text--success"></i> <?php echo app('translator')->get('Application cache will be cleared'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="las la-check-double text--success"></i> <?php echo app('translator')->get('Route cache will be cleared'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="las la-check-double text--success"></i> <?php echo app('translator')->get('Configuration cache will be cleared'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="las la-check-double text--success"></i> <?php echo app('translator')->get('Compiled services and packages files will be removed'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span><i class="las la-check-double text--success"></i> <?php echo app('translator')->get('Caches will be cleared'); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(route('admin.system.optimize.clear')); ?>" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Click to clear'); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
<style>
  .list-group-item span{
    font-size: 22px !important;
    padding: 8px 0px
  }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/system/optimize.blade.php ENDPATH**/ ?>