<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Name'); ?></th>
                                <th><?php echo app('translator')->get('Slug'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(__($data->name)); ?></td>
                                    <td><?php echo e(__($data->slug)); ?></td>
                                    <td>
                                        <div class="button--group">
                                            <a href="<?php echo e(route('admin.frontend.manage.pages.seo',$data->id)); ?>" class="btn btn-sm btn-outline--info"><i class="la la-cog"></i> <?php echo app('translator')->get('SEO Setting'); ?></a>
                                            <a href="<?php echo e(route('admin.frontend.manage.section', $data->id)); ?>" class="btn btn-sm btn-outline--primary"><i class="la la-pen"></i> <?php echo app('translator')->get('Edit'); ?></a>
                                            <?php if($data->is_default == Status::NO): ?>
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn"
                                                data-action="<?php echo e(route('admin.frontend.manage.pages.delete',$data->id)); ?>"
                                                data-question="<?php echo app('translator')->get('Are you sure to remove this page?'); ?>">
                                                    <i class="las la-trash"></i> <?php echo app('translator')->get('Delete'); ?>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <?php echo app('translator')->get('Add New Page'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.frontend.manage.pages.save')); ?>" class="disableSubmission" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label> <?php echo app('translator')->get('Page Name'); ?></label>
                                <a href="javascript:void(0)" class="buildSlug"><i class="las la-link"></i> <?php echo app('translator')->get('Make Slug'); ?></a>
                            </div>
                            <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label> <?php echo app('translator')->get('Slug'); ?></label>
                                <div class="slug-verification d-none"></div>
                            </div>
                            <input type="text" class="form-control" name="slug" value="<?php echo e(old('slug')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Sections'); ?></label>
                            <div class="border rounded p-2" style="max-height:200px; overflow-y:auto;">
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!isset($sec['no_selection']) || !$sec['no_selection']): ?>
                                        <label class="d-block mb-1">
                                            <input type="checkbox" name="secs[]" value="<?php echo e($key); ?>"> <?php echo e(__($sec['name'])); ?>

                                        </label>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <small class="text-muted"><?php echo app('translator')->get('Select the sections to show on this page. You can reorder or change them later from the Edit button.'); ?></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45 disabled"><?php echo app('translator')->get('Submit'); ?></button>
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
    <button type="button" class="btn btn-sm btn-outline--primary addBtn"><i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

    <script>
        (function ($) {
            "use strict";

            $('.addBtn').on('click', function () {
                var modal = $('#addModal');
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

            $('.buildSlug').on('click',function(){
                let closestForm = $(this).closest('form');
                let title = closestForm.find('[name=name]').val();
                closestForm.find('[name=slug]').val(title);
                closestForm.find('[name=slug]').trigger('input');
            });

            $('[name=slug]').on('input',function(){
                let closestForm = $(this).closest('form');
                closestForm.find('[type=submit]').addClass('disabled')
                let slug = $(this).val();
                slug = slug.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
                $(this).val(slug);
                if (slug) {
                    $('.slug-verification').removeClass('d-none');
                    $('.slug-verification').html(`
                        <small class="text--info"><i class="las la-spinner la-spin"></i> <?php echo app('translator')->get('Checking'); ?></small>
                    `);
                    $.get("<?php echo e(route('admin.frontend.manage.pages.check.slug')); ?>", {slug:slug},function(response){
                        if (!response.exists) {
                            $('.slug-verification').html(`
                                <small class="text--success"><i class="las la-check"></i> <?php echo app('translator')->get('Available'); ?></small>
                            `);
                            closestForm.find('[type=submit]').removeClass('disabled')
                        }
                        if (response.exists) {
                            $('.slug-verification').html(`
                                <small class="text--danger"><i class="las la-times"></i> <?php echo app('translator')->get('Slug already exists'); ?></small>
                            `);
                        }
                    });
                }else{
                    $('.slug-verification').addClass('d-none');
                }
            })

        })(jQuery);

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/frontend/builder/pages.blade.php ENDPATH**/ ?>