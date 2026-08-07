<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card bl--5 border--warning">
                <div class="card-body">
                    <p class="text--warning"><?php echo app('translator')->get('The SEO setting is optional for this page. If you don\'t configure SEO here, the global SEO contents will work for this page, which you can configure from'); ?> <a href="<?php echo e(route('admin.seo')); ?>"><?php echo app('translator')->get('System Setting > SEO Configuration'); ?>.</a></p>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="type" value="data">
                        <input type="hidden" name="seo_image" value="1">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('SEO Image'); ?></label>
                                    <?php if (isset($component)) { $__componentOriginaldbcc027cdd3569f61821c56d10b77c01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbcc027cdd3569f61821c56d10b77c01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-uploader','data' => ['class' => 'w-100','imagePath' => getImage(getFilePath('seo') . '/' . @$page->seo_content->image, getFileSize('seo')),'size' => getFileSize('seo'),'required' => false,'name' => 'image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image-uploader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-100','imagePath' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(getImage(getFilePath('seo') . '/' . @$page->seo_content->image, getFileSize('seo'))),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(getFileSize('seo')),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'name' => 'image']); ?>
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

                            <div class="col-xl-8 mt-xl-0 mt-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Meta Keywords'); ?></label>
                                    <small class="ms-2 mt-2  "><?php echo app('translator')->get('Separate multiple keywords by'); ?> <code>,</code>(<?php echo app('translator')->get('comma'); ?>) <?php echo app('translator')->get('or'); ?> <code><?php echo app('translator')->get('enter'); ?></code> <?php echo app('translator')->get('key'); ?></small>
                                    <select name="keywords[]" class="form-control select2-auto-tokenize" multiple="multiple">
                                        <?php if(@$page->seo_content->keywords): ?>
                                            <?php $__currentLoopData = $page->seo_content->keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option); ?>" selected><?php echo e(__($option)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Meta Robots'); ?> <small>(<?php echo app('translator')->get('optional'); ?>)</small></label>
                                    <input type="text" class="form-control" name="meta_robots" value="<?php echo e(isset($page->seo_content->meta_robots) ? $page->seo_content->meta_robots : ''); ?>" placeholder="e.g. noindex, follow">
                                </div>

                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Meta Description'); ?></label>
                                    <textarea name="description" rows="3" class="form-control"><?php echo e(@$page->seo_content->description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Social Title'); ?></label>
                                    <input type="text" class="form-control" name="social_title" value="<?php echo e(@$page->seo_content->social_title); ?>" />
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Social Description'); ?></label>
                                    <textarea name="social_description" rows="3" class="form-control"><?php echo e(@$page->seo_content->social_description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/frontend/builder/seo.blade.php ENDPATH**/ ?>