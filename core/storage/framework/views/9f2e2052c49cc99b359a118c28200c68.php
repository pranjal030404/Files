<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
              <div class="card-body p-0">
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span><?php echo e(keyToTitle(systemDetails()['name'])); ?> <?php echo app('translator')->get('Version'); ?></span>
                    <span><?php echo e(systemDetails()['version']); ?></span>
                  </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('ViserAdmin Version'); ?></span>
                        <span><?php echo e(systemDetails()['build_version']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Laravel Version'); ?></span>
                        <span><?php echo e($laravelVersion); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Timezone'); ?></span>
                        <span><?php echo e(@$timeZone); ?></span>
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

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/system/info.blade.php ENDPATH**/ ?>