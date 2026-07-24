<?php $__env->startSection('content'); ?>
<?php
    $sidenav = file_get_contents(resource_path('views/admin/partials/sidenav.json'));
?>
    <!-- page-wrapper start -->
    <div class="page-wrapper default-version">
        <?php echo $__env->make('admin.partials.sidenav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('admin.partials.topnav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="container-fluid px-3 px-sm-0">
            <div class="body-wrapper">
                <div class="bodywrapper__inner">

                    <?php echo $__env->yieldPushContent('topBar'); ?>
                    <?php echo $__env->make('admin.partials.breadcrumb', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <?php echo $__env->yieldContent('panel'); ?>

                </div>
            </div><!-- body-wrapper end -->
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal362d9e6dc0f524228bb1433883f75881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal362d9e6dc0f524228bb1433883f75881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.config-process','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('config-process'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal362d9e6dc0f524228bb1433883f75881)): ?>
<?php $attributes = $__attributesOriginal362d9e6dc0f524228bb1433883f75881; ?>
<?php unset($__attributesOriginal362d9e6dc0f524228bb1433883f75881); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal362d9e6dc0f524228bb1433883f75881)): ?>
<?php $component = $__componentOriginal362d9e6dc0f524228bb1433883f75881; ?>
<?php unset($__componentOriginal362d9e6dc0f524228bb1433883f75881); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>