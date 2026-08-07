<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('S.N.'); ?></th>
                                <th><?php echo app('translator')->get('name'); ?></th>
                                <th><?php echo app('translator')->get('Interest Express Limit'); ?></th>
                                <th><?php echo app('translator')->get('Profile Show Limit'); ?></th>
                                <th><?php echo app('translator')->get('Image Upload Limit'); ?></th>
                                <th><?php echo app('translator')->get('Validity Period'); ?></th>
                                <th><?php echo app('translator')->get('Price'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($packages->firstItem() + $loop->index); ?></td>
                                    <td>
                                        <span class="fw-bold"><?php echo e(__($package->name)); ?></span>
                                    </td>
                                    <td>
                                        <?php if($package->interest_express_limit == -1): ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Unlimited'); ?></span>
                                        <?php else: ?>
                                            <?php echo e($package->interest_express_limit); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($package->contact_view_limit == -1): ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Unlimited'); ?></span>
                                        <?php else: ?>
                                            <?php echo e($package->contact_view_limit); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($package->image_upload_limit == -1): ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Unlimited'); ?></span>
                                        <?php else: ?>
                                            <?php echo e($package->image_upload_limit); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($package->validity_period == -1): ?>
                                            <span class="badge badge--dark"><?php echo app('translator')->get('Unlimited'); ?></span>
                                        <?php else: ?>
                                            <?php echo e($package->validity_period); ?> <?php echo app('translator')->get('Days'); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="fw-bold"><?php echo e(showAmount($package->price)); ?> </span>
                                    </td>
                                    <td>
                                        <?php echo $package->statusBadge ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-wrap gap-1">
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Update Package'); ?>" data-resource="<?php echo e($package); ?>" type="button"><i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?></button>

                                            <?php if($package->status): ?>
                                                <button type="button" class="btn btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.package.update.status', $package->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure that you want to disable this package?'); ?>"> <i class="las la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?></button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-outline--success confirmationBtn" data-action="<?php echo e(route('admin.package.update.status', $package->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure that you want to enable this package?'); ?>"> <i class="las la-eye"></i><?php echo app('translator')->get('Enable'); ?></button>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e($emptyMessage); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($packages->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($packages)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.package.save')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Name'); ?></label>
                            <input class="form-control" name="name" required type="text">
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Interest Express Limit'); ?><small class="text-muted">(<?php echo app('translator')->get('Enter -1 for unlimited period'); ?>)</small></label>
                            <input class="form-control" min="-1" name="interest_express_limit" required type="number">
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Profile Show Limit'); ?><small class="text-muted">(<?php echo app('translator')->get('Enter -1 for unlimited period'); ?>)</small></label>
                            <input class="form-control" min="-1" name="contact_view_limit" required type="number">
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Image Upload Limit'); ?><small class="text-muted">(<?php echo app('translator')->get('Enter -1 for unlimited period'); ?>)</small></label>
                            <input class="form-control" min="-1" name="image_upload_limit" required type="number">
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Validity Period '); ?><small class="text-muted">(<?php echo app('translator')->get('In Days, Enter -1 for unlimited period'); ?>)</small> </label>
                            <input class="form-control" min="-1" name="validity_period" required type="number">
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Price'); ?></label>
                            <div class="input-group">
                                <input class="form-control" min="0" name="price" required step="any" type="number">
                                <div class="input-group-text">
                                    <?php echo e(__(gs('cur_text'))); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalbd5922df145d522b37bf664b524be380 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd5922df145d522b37bf664b524be380 = $attributes; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ConfirmationModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $attributes = $__attributesOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__attributesOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $component = $__componentOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__componentOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Package'); ?>" type="button">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/package/list.blade.php ENDPATH**/ ?>