<?php if($seo): ?>
    <meta name="title" Content="<?php echo e(gs()->siteName(__($pageTitle))); ?>">
    <meta name="description" content="<?php echo e(isset($seoContents->description) && $seoContents->description ? $seoContents->description : $seo->description); ?>">
    <meta name="keywords" content="<?php echo e(implode(',', ((isset($seoContents->keywords) && $seoContents->keywords) ? $seoContents->keywords : $seo->keywords))); ?>">
    <link rel="shortcut icon" href="<?php echo e(siteFavicon()); ?>" type="image/x-icon">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>" />

    <?php if((isset($seoContents->meta_robots) && $seoContents->meta_robots) || (isset($seo->meta_robots) && $seo->meta_robots)): ?>
        <meta name="robots" content="<?php echo e(isset($seoContents->meta_robots) && $seoContents->meta_robots ? $seoContents->meta_robots : $seo->meta_robots); ?>" />
    <?php endif; ?>

    
    <link rel="apple-touch-icon" href="<?php echo e(siteLogo()); ?>">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php echo e(gs()->siteName($pageTitle)); ?>">
    
    <meta itemprop="name" content="<?php echo e(gs()->siteName($pageTitle)); ?>">
    <meta itemprop="description" content="<?php echo e((isset($seoContents->description) && $seoContents->description) ? $seoContents->description : $seo->description); ?>">
    <meta itemprop="image" content="<?php echo e($seoImage ?? getImage(getFilePath('seo') . '/' . $seo->image)); ?>">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e((isset($seoContents->social_title) && $seoContents->social_title) ? $seoContents->social_title : $seo->social_title); ?>">
    <meta property="og:description" content="<?php echo e((isset($seoContents->social_description) && $seoContents->social_description) ? $seoContents->social_description : $seo->social_description); ?>">
    <meta property="og:image" content="<?php echo e($seoImage ?? getImage(getFilePath('seo') . '/' . $seo->image)); ?>">

    <meta property="og:image:type" content="image/<?php echo e(pathinfo($seoImage ?? getImage(getFilePath('seo')) . '/' . $seo->image)['extension']); ?>">
    <?php $socialImageSize = explode('x', getFileSize('seo')) ?>
    <meta property="og:image:width" content="<?php echo e($socialImageSize[0]); ?>">
    <meta property="og:image:height" content="<?php echo e($socialImageSize[1]); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
<?php endif; ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/partials/seo.blade.php ENDPATH**/ ?>