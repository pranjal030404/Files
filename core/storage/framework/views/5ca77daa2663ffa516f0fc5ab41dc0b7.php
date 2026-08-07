<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-4 col-sm-6">
                                <div class="form-group ">
                                    <label> <?php echo app('translator')->get('Site Title'); ?></label>
                                    <input class="form-control" type="text" name="site_name" required value="<?php echo e(gs('site_name')); ?>">
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="form-group ">
                                    <label><?php echo app('translator')->get('Currency'); ?></label>
                                    <input class="form-control" type="text" name="cur_text" required value="<?php echo e(gs('cur_text')); ?>">
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="form-group ">
                                    <label><?php echo app('translator')->get('Currency Symbol'); ?></label>
                                    <input class="form-control" type="text" name="cur_sym" required value="<?php echo e(gs('cur_sym')); ?>">
                                </div>
                            </div>
                            <div class="form-group col-xl-4 col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Timezone'); ?></label>
                                <select class="select2 form-control" name="timezone" >
                                    <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(@$key); ?>" <?php if(@$key == $currentTimezone): echo 'selected'; endif; ?>><?php echo e(__($timezone)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-xl-4 col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Site Base Color'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input type='text' class="form-control colorPicker" value="<?php echo e(gs('base_color')); ?>">
                                    </span>
                                    <input type="text" class="form-control colorCode" name="base_color" value="<?php echo e(gs('base_color')); ?>">
                                </div>
                            </div>
                            <div class="form-group col-xl-4 col-sm-6">
                                <label class="required"> <?php echo app('translator')->get('Site Secondary Color'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input type='text' class="form-control colorPicker" value="<?php echo e(gs('secondary_color')); ?>">
                                    </span>
                                    <input type="text" class="form-control colorCode" name="secondary_color" value="<?php echo e(gs('secondary_color')); ?>">
                                </div>
                            </div>

                            <div class="form-group col-xl-4 col-sm-6">
                                <label><?php echo app('translator')->get('Default Package'); ?>
                                    <span class="text--primary" title="<?php echo app('translator')->get('If you select any of these, it is set as default package and automatically added to the new user profile while he registered.'); ?>"><i class="fas fa-info-circle"></i></span>
                                </label>
                                <select class="form-control" name="default_package">
                                    <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(gs('default_package_id') == $package->id): ?> selected <?php endif; ?> value="<?php echo e($package->id); ?>"><?php echo e(__($package->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-xl-4 col-sm-6">
                                <label> <?php echo app('translator')->get('Record to Display Per page'); ?></label>
                                <select class="select2 form-control" name="paginate_number" data-minimum-results-for-search="-1">
                                    <option value="20" <?php if(gs('paginate_number') == 20 ): echo 'selected'; endif; ?>><?php echo app('translator')->get('20 items per page'); ?></option>
                                    <option value="50" <?php if(gs('paginate_number') == 50 ): echo 'selected'; endif; ?>><?php echo app('translator')->get('50 items per page'); ?></option>
                                    <option value="100" <?php if(gs('paginate_number') == 100 ): echo 'selected'; endif; ?>><?php echo app('translator')->get('100 items per page'); ?></option>
                                </select>
                            </div>

                            <div class="form-group col-xl-4 col-sm-6 ">
                                <label class="required"> <?php echo app('translator')->get('Currency Showing Format'); ?></label>
                                <select class="select2 form-control" name="currency_format" data-minimum-results-for-search="-1">
                                    <option value="1" <?php if(gs('currency_format') == Status::CUR_BOTH): echo 'selected'; endif; ?>><?php echo app('translator')->get('Show Currency Text and Symbol Both'); ?></option>
                                    <option value="2" <?php if(gs('currency_format') == Status::CUR_TEXT): echo 'selected'; endif; ?>><?php echo app('translator')->get('Show Currency Text Only'); ?></option>
                                    <option value="3" <?php if(gs('currency_format') == Status::CUR_SYM): echo 'selected'; endif; ?>><?php echo app('translator')->get('Show Currency Symbol Only'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/admin/js/spectrum.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/spectrum.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";


            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function (color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function () {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/setting/general.blade.php ENDPATH**/ ?>