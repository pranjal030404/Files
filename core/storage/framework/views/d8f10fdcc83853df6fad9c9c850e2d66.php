<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'primary',
    'color' => 'white',
    'icon_color' => null,
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
    'icon' => '',
    'bg' => 'primary',
    'color' => 'white',
    'icon_color' => null,
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

<div class="card bg--<?php echo e($bg); ?> overflow-hidden box--shadow2">
    <?php if($link): ?>
        <a href="<?php echo e($link); ?>" class="item-link"></a>
    <?php endif; ?>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-4">
                <i class="la <?php echo e($icon); ?> f-size--56 text--<?php echo e($iconColor); ?>"></i>
            </div>
            <div class="col-8 text-end">
                <span class="text--<?php echo e($color); ?> text--small"><?php echo e(__($title)); ?></span>
                <h2 class="text--<?php echo e($color); ?>"><?php echo e($value); ?></h2>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/components/widget-1.blade.php ENDPATH**/ ?>