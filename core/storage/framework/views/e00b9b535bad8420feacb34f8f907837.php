<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
              <div class="card-body p-0">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('PHP Version'); ?></span>
                        <span><?php echo e($currentPHP); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server Software'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_SOFTWARE']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server IP Address'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_ADDR']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server Protocol'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_PROTOCOL']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('HTTP Host'); ?></span>
                        <span><?php echo e(@$serverDetails['HTTP_HOST']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server Port'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_PORT']); ?></span>
                    </li>
                </ul>
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

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/system/server.blade.php ENDPATH**/ ?>