<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'link' => '',
    'title' => '',
    'value' => '',
    'heading' => '',
    'subheading' => '',
    'icon' => '',
    'bg' => 'white',
    'color' => 'primary',
    'icon_style' => 'outline',
    'overlay_icon' => 1,
    'cover_cursor' => 0,
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
    'link' => '',
    'title' => '',
    'value' => '',
    'heading' => '',
    'subheading' => '',
    'icon' => '',
    'bg' => 'white',
    'color' => 'primary',
    'icon_style' => 'outline',
    'overlay_icon' => 1,
    'cover_cursor' => 0,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<div class="widget-two box--shadow2 b-radius--5 <?php if($cover_cursor && $link): ?> has-link <?php endif; ?> bg--<?php echo e($bg); ?>">

    <?php if($cover_cursor): ?>
    <a href="<?php echo e($link); ?>" class="item-link"></a>
    <?php endif; ?>
    <?php if((bool) $overlay_icon): ?>
        <i class="<?php echo e($icon); ?> overlay-icon text--<?php echo e($color); ?>"></i>
    <?php endif; ?>

    <div class="widget-two__icon b-radius--5  <?php if($icon_style == 'outline'): ?> border border--<?php echo e($color); ?> text--<?php echo e($color); ?> <?php else: ?> bg--<?php echo e($color); ?> <?php endif; ?> ">
        <i class="<?php echo e($icon); ?>"></i>
    </div>

    <div class="widget-two__content">
        <h3><?php echo e($value || $value === "0" || $value === 0 ? $value : __($heading)); ?></h3>
        <p><?php echo e(__($title ? $title : $subheading)); ?></p>
    </div>

    <?php if($link && !$cover_cursor): ?>
        <a href="<?php echo e($link); ?>" class="widget-two__btn btn btn-outline--<?php echo e($color); ?>"><?php echo app('translator')->get('View All'); ?></a>
    <?php endif; ?>
</div>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/components/widget-2.blade.php ENDPATH**/ ?>