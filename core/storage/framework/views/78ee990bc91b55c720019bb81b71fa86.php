<?php
    $activePackages = \App\Models\Package::active();
    $packages = (clone $activePackages)
        ->orderBy('price', 'ASC')
        ->take(4)
        ->get();
    $totalPackage = $activePackages->count();
?>
<?php echo $__env->make($activeTemplate . 'partials.package', ['packages' => $packages, 'totalPackage' => $totalPackage], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/package.blade.php ENDPATH**/ ?>