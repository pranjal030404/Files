<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'style' => 1,
    'link' => null,
    'title' => null,
    'value' => null,
    'heading' => null,
    'subheading' => null,
    'icon' => null,
    'bg' => null,
    'color' => null,
    'icon_color' => null,
    'icon_style' => 'outline',
    'overlay_icon' => 1,
    'cover_cursor' => 0,
    'outline' => false,
    'type' => 1,
    'viewMoreIcon' => true,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'style' => 1,
    'link' => null,
    'title' => null,
    'value' => null,
    'heading' => null,
    'subheading' => null,
    'icon' => null,
    'bg' => null,
    'color' => null,
    'icon_color' => null,
    'icon_style' => 'outline',
    'overlay_icon' => 1,
    'cover_cursor' => 0,
    'outline' => false,
    'type' => 1,
    'viewMoreIcon' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $iconColor = $icon_color ?? $color;
?>

<?php if($style == 1): ?>
    <?php if (isset($component)) { $__componentOriginalad68236d3f05becdcbf1219a0d3d53f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalad68236d3f05becdcbf1219a0d3d53f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-1','data' => ['link' => $link,'title' => $title,'value' => $value,'icon' => $icon,'bg' => $bg,'color' => $color,'iconColor' => $icon_color]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-1'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'icon_color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon_color)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalad68236d3f05becdcbf1219a0d3d53f3)): ?>
<?php $attributes = $__attributesOriginalad68236d3f05becdcbf1219a0d3d53f3; ?>
<?php unset($__attributesOriginalad68236d3f05becdcbf1219a0d3d53f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalad68236d3f05becdcbf1219a0d3d53f3)): ?>
<?php $component = $__componentOriginalad68236d3f05becdcbf1219a0d3d53f3; ?>
<?php unset($__componentOriginalad68236d3f05becdcbf1219a0d3d53f3); ?>
<?php endif; ?>
<?php endif; ?>

<?php if($style == 2): ?>
    <?php if (isset($component)) { $__componentOriginalab30449a9cdc2da6dcecc14c5aa1e0d9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab30449a9cdc2da6dcecc14c5aa1e0d9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-2','data' => ['link' => $link,'title' => $title,'value' => $value,'heading' => $heading,'subheading' => $subheading,'icon' => $icon,'bg' => $bg,'color' => $color,'iconColor' => $icon_color,'iconStyle' => $icon_style,'overlayIcon' => $overlay_icon,'coverCursor' => $cover_cursor]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'subheading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subheading),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'icon_color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon_color),'icon_style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon_style),'overlay_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($overlay_icon),'cover_cursor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cover_cursor)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab30449a9cdc2da6dcecc14c5aa1e0d9)): ?>
<?php $attributes = $__attributesOriginalab30449a9cdc2da6dcecc14c5aa1e0d9; ?>
<?php unset($__attributesOriginalab30449a9cdc2da6dcecc14c5aa1e0d9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab30449a9cdc2da6dcecc14c5aa1e0d9)): ?>
<?php $component = $__componentOriginalab30449a9cdc2da6dcecc14c5aa1e0d9; ?>
<?php unset($__componentOriginalab30449a9cdc2da6dcecc14c5aa1e0d9); ?>
<?php endif; ?>
<?php endif; ?>

<?php if($style == 3): ?>
    <?php if (isset($component)) { $__componentOriginalc41dbc949fa80d765c4405b003eac788 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc41dbc949fa80d765c4405b003eac788 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-3','data' => ['link' => $link,'title' => $title,'value' => $value,'icon' => $icon,'bg' => $bg,'color' => $color]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-3'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc41dbc949fa80d765c4405b003eac788)): ?>
<?php $attributes = $__attributesOriginalc41dbc949fa80d765c4405b003eac788; ?>
<?php unset($__attributesOriginalc41dbc949fa80d765c4405b003eac788); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc41dbc949fa80d765c4405b003eac788)): ?>
<?php $component = $__componentOriginalc41dbc949fa80d765c4405b003eac788; ?>
<?php unset($__componentOriginalc41dbc949fa80d765c4405b003eac788); ?>
<?php endif; ?>
<?php endif; ?>
<?php if($style == 4): ?>
    <?php if (isset($component)) { $__componentOriginald1794829eb849952e674ff185f8062bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1794829eb849952e674ff185f8062bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-4','data' => ['link' => $link,'title' => $title,'value' => $value,'bg' => $bg,'color' => $color]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-4'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1794829eb849952e674ff185f8062bc)): ?>
<?php $attributes = $__attributesOriginald1794829eb849952e674ff185f8062bc; ?>
<?php unset($__attributesOriginald1794829eb849952e674ff185f8062bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1794829eb849952e674ff185f8062bc)): ?>
<?php $component = $__componentOriginald1794829eb849952e674ff185f8062bc; ?>
<?php unset($__componentOriginald1794829eb849952e674ff185f8062bc); ?>
<?php endif; ?>
<?php endif; ?>
<?php if($style == 5): ?>
    <?php if (isset($component)) { $__componentOriginala3ac005032d83bd44a174514c24b5203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3ac005032d83bd44a174514c24b5203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-5','data' => ['link' => $link,'title' => $title,'value' => $value,'icon' => $icon,'bg' => $bg]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-5'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3ac005032d83bd44a174514c24b5203)): ?>
<?php $attributes = $__attributesOriginala3ac005032d83bd44a174514c24b5203; ?>
<?php unset($__attributesOriginala3ac005032d83bd44a174514c24b5203); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3ac005032d83bd44a174514c24b5203)): ?>
<?php $component = $__componentOriginala3ac005032d83bd44a174514c24b5203; ?>
<?php unset($__componentOriginala3ac005032d83bd44a174514c24b5203); ?>
<?php endif; ?>
<?php endif; ?>
<?php if($style == 6): ?>
    <?php if (isset($component)) { $__componentOriginal2ad2d1c5098a2b04aca209a847e89829 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ad2d1c5098a2b04aca209a847e89829 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-6','data' => ['link' => $link,'title' => $title,'value' => $value,'icon' => $icon,'bg' => $bg,'outline' => $outline,'heading' => $heading,'subheading' => $subheading,'viewMoreIcon' => $viewMoreIcon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-6'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg),'outline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($outline),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'subheading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subheading),'viewMoreIcon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($viewMoreIcon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ad2d1c5098a2b04aca209a847e89829)): ?>
<?php $attributes = $__attributesOriginal2ad2d1c5098a2b04aca209a847e89829; ?>
<?php unset($__attributesOriginal2ad2d1c5098a2b04aca209a847e89829); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ad2d1c5098a2b04aca209a847e89829)): ?>
<?php $component = $__componentOriginal2ad2d1c5098a2b04aca209a847e89829; ?>
<?php unset($__componentOriginal2ad2d1c5098a2b04aca209a847e89829); ?>
<?php endif; ?>
<?php endif; ?>
<?php if($style == 7): ?>
    <?php if (isset($component)) { $__componentOriginal8669c968d2fc70faf902fd25be99e648 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8669c968d2fc70faf902fd25be99e648 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget-7','data' => ['link' => $link,'title' => $title,'value' => $value,'icon' => $icon,'bg' => $bg,'outline' => $outline,'type' => $type]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widget-7'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($link),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'bg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bg),'outline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($outline),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8669c968d2fc70faf902fd25be99e648)): ?>
<?php $attributes = $__attributesOriginal8669c968d2fc70faf902fd25be99e648; ?>
<?php unset($__attributesOriginal8669c968d2fc70faf902fd25be99e648); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8669c968d2fc70faf902fd25be99e648)): ?>
<?php $component = $__componentOriginal8669c968d2fc70faf902fd25be99e648; ?>
<?php unset($__componentOriginal8669c968d2fc70faf902fd25be99e648); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/components/widget.blade.php ENDPATH**/ ?>