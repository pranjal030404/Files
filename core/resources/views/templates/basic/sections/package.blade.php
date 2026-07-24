@php
    $activePackages = \App\Models\Package::active();
    $packages = (clone $activePackages)
        ->orderBy('price', 'ASC')
        ->take(4)
        ->get();
    $totalPackage = $activePackages->count();
@endphp
@include($activeTemplate . 'partials.package', ['packages' => $packages, 'totalPackage' => $totalPackage])
