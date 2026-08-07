<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.frontend.sections.content', $key)); ?>" class="disableSubmission" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="type" value="element">
                        <?php if(isset($data)): ?>
                            <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                        <?php endif; ?>
                        <div class="row">
                            <?php
                                $imgCount = 0;
                            ?>
                            <?php $__currentLoopData = $section->element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($k == 'images'): ?>
                                    <?php
                                        $imgCount = collect($content)->count();
                                    ?>
                                    <?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgKey => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4">
                                            <input type="hidden" name="has_image[]" value="1">
                                            <div class="form-group">
                                                <label><?php echo e(__(keyToTitle($imgKey))); ?></label>
                                                <?php if (isset($component)) { $__componentOriginaldbcc027cdd3569f61821c56d10b77c01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-uploader','data' => ['class' => 'w-100','imagePath' => frontendImage($key, (isset($data->data_values->$imgKey) ? $data->data_values->$imgKey : ''),$section->element->images->$imgKey->size),'name' => 'image_input['.e($imgKey).']','id' => 'image-upload-input'.e($loop->index).'','size' => isset($section->element->images->$imgKey->size) ? $section->element->images->$imgKey->size : null,'required' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image-uploader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-100','imagePath' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(frontendImage($key, (isset($data->data_values->$imgKey) ? $data->data_values->$imgKey : ''),$section->element->images->$imgKey->size)),'name' => 'image_input['.e($imgKey).']','id' => 'image-upload-input'.e($loop->index).'','size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($section->element->images->$imgKey->size) ? $section->element->images->$imgKey->size : null),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbcc027cdd3569f61821c56d10b77c01)): ?>
<?php $attributes = $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01; ?>
<?php unset($__attributesOriginaldbcc027cdd3569f61821c56d10b77c01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbcc027cdd3569f61821c56d10b77c01)): ?>
<?php $component = $__componentOriginaldbcc027cdd3569f61821c56d10b77c01; ?>
<?php unset($__componentOriginaldbcc027cdd3569f61821c56d10b77c01); ?>
<?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="<?php if($imgCount > 1): ?> col-md-12 <?php else: ?> col-md-8 <?php endif; ?>">
                                        <?php $__env->startPush('divend'); ?>
                                        </div>
                                    <?php $__env->stopPush(); ?>
                                <?php elseif($content == 'icon'): ?>
                                    <div class="form-group">
                                        <label><?php echo e(keyToTitle($k)); ?></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control iconPicker icon" autocomplete="off" name="<?php echo e($k); ?>" value="<?php echo e(old($k, isset($data->data_values->$k) ? $data->data_values->$k : '')); ?>" required>
                                            <span class="input-group-text  input-group-addon" data-icon="las la-home" role="iconpicker"></span>
                                        </div>
                                    </div>
                                <?php else: ?>

                                    <?php if($content == 'textarea'): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo e(__(keyToTitle($k))); ?></label>
                                                <textarea rows="10" class="form-control" name="<?php echo e($k); ?>" required><?php echo e(old($k, isset($data->data_values->$k) ? $data->data_values->$k : '' )); ?></textarea>
                                            </div>
                                        </div>
                                    <?php elseif($content == 'textarea-nic'): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo e(__(keyToTitle($k))); ?></label>
                                                <textarea rows="10" class="form-control nicEdit" name="<?php echo e($k); ?>"><?php echo e(old($k, isset($data->data_values->$k) ? $data->data_values->$k : '' )); ?></textarea>
                                            </div>
                                        </div>
                                    <?php elseif($k == 'select'): ?>
                                        <?php
                                            $selectName = $content->name;
                                        ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo e(__(keyToTitle($selectName))); ?></label>
                                                <select class="form-control select2" data-minimum-results-for-search="-1" name="<?php echo e($selectName); ?>" required>
                                                    <?php $__currentLoopData = $content->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectItemKey => $selectOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($selectItemKey); ?>" <?php if((isset($data->data_values->$selectName) ? $data->data_values->$selectName : '') == $selectItemKey): ?> selected <?php endif; ?>><?php echo e(__($selectOption)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php elseif($k == 'slug'): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label><?php echo e(__(keyToTitle($k))); ?></label>
                                                    <div class="slug-verification d-none"></div>
                                                </div>
                                                <input type="text" class="form-control" name="slug" value="<?php echo e(old($k, isset($data->slug) ? $data->slug : '')); ?>" required>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label><?php echo e(__(keyToTitle($k))); ?></label>
                                                    <?php if((isset($section->element->slug) ? $section->element->slug : '') == $k): ?>
                                                        <a href="javascript:void(0)" class="buildSlug"><i class="las la-link"></i> <?php echo app('translator')->get('Make Slug'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="text" class="form-control" name="<?php echo e($k); ?>" value="<?php echo e(old($k, isset($data->data_values->$k) ? $data->data_values->$k : '' )); ?>" required>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->yieldPushContent('divend'); ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary <?php if(isset($section->element->slug) && !isset($data)): ?> disabled <?php endif; ?> w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.frontend.sections', $key)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.frontend.sections', $key)).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5)): ?>
<?php $attributes = $__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5; ?>
<?php unset($__attributesOriginal3b9bf6c313f6db4d5c9389e5666c89a5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5)): ?>
<?php $component = $__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5; ?>
<?php unset($__componentOriginal3b9bf6c313f6db4d5c9389e5666c89a5); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/fontawesome-iconpicker.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/fontawesome-iconpicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
            });

            <?php if(isset($section->element->slug) && $section->element->slug): ?>
                $('.buildSlug').on('click',function(){
                    let slugKey = '<?php echo e($section->element->slug); ?>';
                    let closestForm = $(this).closest('form');
                    let title = closestForm.find(`[name=${slugKey}]`).val();
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
                        closestForm.find('.slug-verification').removeClass('d-none');
                        closestForm.find('.slug-verification').html(`
                            <small class="text--info"><i class="las la-spinner la-spin"></i> <?php echo app('translator')->get('Checking'); ?></small>
                        `);
                        $.get("<?php echo e(route('admin.frontend.sections.element.slug.check',[$key, isset($data->id) ? $data->id : ''])); ?>", {slug:slug},function(response){
                            if (!response.exists) {
                                closestForm.find('.slug-verification').html(`
                                    <small class="text--success"><i class="las la-check"></i> <?php echo app('translator')->get('Available'); ?></small>
                                `);
                                closestForm.find('[type=submit]').removeClass('disabled')
                            }
                            if (response.exists) {
                                closestForm.find('.slug-verification').html(`
                                    <small class="text--danger"><i class="las la-times"></i> <?php echo app('translator')->get('Slug already exists'); ?></small>
                                `);
                            }
                        });
                    }else{
                        closestForm.find('.slug-verification').addClass('d-none');
                    }
                })
            <?php endif; ?>
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/frontend/element.blade.php ENDPATH**/ ?>