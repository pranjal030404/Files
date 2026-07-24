<?php
    use App\Constants\Status;
    $footerContent = getContent('footer.content', true);
    $contactContent = getContent('contact_us.content', true);
    $policyPageElement = getContent('policy_pages.element', false, null, true);
    $pages = App\Models\Page::where('tempname', activeTemplate())
        ->where('is_default', Status::NO)
        ->get();
?>
<!-- Footer  -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__content section">
                    <div class="row g-4 justify-content-xl-between">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer__contact">
                                <h4 class="footer__title text--white mt-0">
                                    <?php echo e(__(@$footerContent->data_values->title)); ?></h4>
                                <p class="text--white">
                                    <?php echo e(__(@$footerContent->data_values->description)); ?>

                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 col-xl-2">
                            <h4 class="footer__title text--white mt-0"><?php echo app('translator')->get('Quick Links'); ?></h4>
                            <ul class="footer__contact list list--base list--column">
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="<?php echo e(route('home')); ?>"> <?php echo app('translator')->get('Home'); ?></a>
                                </li>
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="<?php echo e(route('stories')); ?>">
                                        <?php echo app('translator')->get('Stories'); ?></a>
                                </li>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="t-link t-link--base text--white d-inline-block" href="<?php echo e(url($page->slug)); ?>"><?php echo e(__($page->name)); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li class="list--column__item">
                                    <a class="t-link t-link--base text--white d-inline-block" href="<?php echo e(route('contact')); ?>">
                                        <?php echo app('translator')->get('Contact'); ?></a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 col-lg-3 col-xl-2">
                            <h4 class="footer__title text--white mt-0"><?php echo app('translator')->get('Policies'); ?></h4>
                            <ul class="footer__contact list list--base list--column">
                                <?php $__currentLoopData = $policyPageElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="t-link t-link--base text--white d-inline-block" href="<?php echo e(route('policy.pages', [slug($policy->data_values->title)])); ?>"><?php echo e(__($policy->data_values->title)); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <h4 class="footer__title text--white mt-0"><?php echo app('translator')->get('Contact Us'); ?></h4>
                            <ul class="footer__contact list list--column mt-4">
                                <li><i class="fas fa-phone-alt"></i> <a class="t-link t-link--base text--white d-inline-block" href="tel: <?php echo e(@$contactContent->data_values->contact_number); ?>"><?php echo e(@$contactContent->data_values->contact_number); ?></a>
                                </li>
                                <li><i class="far fa-envelope"></i> <a class="t-link t-link--base text--white d-inline-block" href="mailto: <?php echo e(@$contactContent->data_values->email); ?>"><?php echo e(@$contactContent->data_values->email); ?></a>
                                </li>
                                <li class="address"><i class="fas fa-map-marker-alt"></i><?php echo e(@$contactContent->data_values->office); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__copyright">
                    <p class="sm-text text--white mb-0 text-center">
                        <?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?>. <?php echo app('translator')->get('All Rights Reserved By'); ?>
                        <a class="t-link t-link--base text--base" href="<?php echo e(route('home')); ?>"><?php echo e(gs('site_name')); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>