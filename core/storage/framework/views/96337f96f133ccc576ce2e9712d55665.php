<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Type'); ?></th>
                                    <th><?php echo app('translator')->get('Message'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(isset($report->req_type) ? $report->req_type : ''); ?></td>
                                        <td class="text-center white-space-wrap"><?php echo e(isset($report->message) ? $report->message : ''); ?></td>
                                        <td><span class="badge badge--<?php echo e(isset($report->status_class) ? $report->status_class : ''); ?>"><?php echo e(isset($report->status_text) ? $report->status_text : ''); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bugModal" tabindex="-1" role="dialog" aria-labelledby="bugModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bugModalLabel"><?php echo app('translator')->get('Report & Request'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="disableSubmission" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Type'); ?></label>
                            <select class="form-control select2" data-minimum-results-for-search="-1" name="type" required>
                                <option value="bug" <?php if(old('type') == 'bug'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Report Bug'); ?></option>
                                <option value="feature" <?php if(old('type') == 'feature'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Feature Request'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Message'); ?></label>
                            <textarea class="form-control" name="message" rows="5" required><?php echo e(old('message')); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button class="btn btn-sm btn-outline--warning" data-bs-toggle="modal" data-bs-target="#bugModal"><i class="las la-bug"></i> <?php echo app('translator')->get('Report a bug'); ?></button>
    <a href="https://viserlab.com/support" target="_blank" class="btn btn-sm btn-outline--success"><i class="las la-headset"></i> <?php echo app('translator')->get('Request for Support'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/reports.blade.php ENDPATH**/ ?>